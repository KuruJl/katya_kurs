#syntax=docker/dockerfile:1
# Final Simplification

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
    
    # --- ЭТАП 3: Финальный образ ---
    FROM php:8.2-fpm-alpine
    
    # Устанавливаем ТОЛЬКО Nginx. Supervisor больше не нужен.
    RUN apk add --no-cache nginx
    RUN docker-php-ext-install pdo pdo_mysql
    
    WORKDIR /var/www/html
    
    COPY --from=vendor /app/vendor/ ./vendor/
    COPY --from=frontend /app/public/ ./public/
    COPY . .
    
    # Копируем только то, что нужно
    COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
    COPY .docker/nginx.conf /etc/nginx/http.d/default.conf # <-- Обратите внимание на путь!
    
    RUN chmod +x /usr/local/bin/entrypoint.sh
    COPY .env.example .env
    
    # Кэшируем конфиги на этапе сборки
    RUN php artisan config:cache && \
        php artisan route:cache && \
        php artisan view:cache
    
    # Единственная команда запуска - наш скрипт
    CMD ["/usr/local/bin/entrypoint.sh"]