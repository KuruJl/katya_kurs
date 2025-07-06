#syntax=docker/dockerfile:1
# Final rebuild: 2025-07-06

# --- ЭТАП 1: vendor (без изменений) ---
    FROM composer:2 as vendor
    WORKDIR /app
    COPY database/ database/
    COPY composer.json composer.json
    COPY composer.lock composer.lock
    RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist
    
    # --- ЭТАП 2: frontend (без изменений) ---
    FROM node:18-alpine as frontend
    WORKDIR /app
    COPY package.json package-lock.json ./
    RUN npm ci
    COPY . .
    RUN npm run build
    
    # --- ЭТАП 3: Финальный образ для продакшена ---
    FROM php:8.2-fpm-alpine
    
    # Устанавливаем зависимости
    RUN apk add --no-cache nginx supervisor
    RUN docker-php-ext-install pdo pdo_mysql
    
    # Копируем наш новый скрипт-инициализатор и делаем его исполняемым
    COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
    RUN chmod +x /usr/local/bin/entrypoint.sh
    
    WORKDIR /var/www/html
    
    # Копируем все остальное
    COPY --from=vendor /app/vendor/ ./vendor/
    COPY --from=frontend /app/public/ ./public/
    COPY . .
    COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
    COPY .docker/www.conf /usr/local/etc/php-fpm.d/www.conf
    COPY .docker/nginx.conf /etc/nginx/nginx.conf
    COPY .env.example .env
    
    # Кэшируем конфиги (это можно оставить здесь)
    RUN php artisan config:cache && \
        php artisan route:cache && \
        php artisan view:cache
    
    # Указываем, что наш скрипт должен запускаться ПЕРЕД основной командой
    ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
    
    # Основная команда, которая будет передана в entrypoint.sh
    CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]