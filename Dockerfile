#syntax=docker/dockerfile:1
# Trigger rebuild: 2025-07-06 08:15

# --- ЭТАП 1: Установка PHP зависимостей ('vendor') ---
    FROM composer:2 as vendor
    WORKDIR /app
    COPY database/ database/
    COPY composer.json composer.json
    COPY composer.lock composer.lock
    RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist
    
    # --- ЭТАП 2: Сборка фронтенда ('frontend') ---
    FROM node:18-alpine as frontend
    WORKDIR /app
    COPY package.json package-lock.json ./
    RUN npm ci
    COPY . .
    RUN npm run build
    
    # --- ЭТАП 3: Финальный образ для продакшена ---
    FROM php:8.2-fpm-alpine
    
    # Устанавливаем Nginx И SUPERVISOR
    RUN apk add --no-cache nginx supervisor sed
    
    # Устанавливаем PHP расширения
    RUN docker-php-ext-install pdo pdo_mysql
    
    WORKDIR /var/www/html
    
    # Копируем артефакты с предыдущих этапов
    COPY --from=vendor /app/vendor/ ./vendor/
    COPY --from=frontend /app/public/ ./public/
    COPY . .
    
    # Копируем конфигурации
    COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
    COPY .docker/www.conf /usr/local/etc/php-fpm.d/www.conf
    COPY .docker/nginx.conf /etc/nginx/nginx.conf
    
    # Копируем .env.example, чтобы artisan мог работать
    COPY .env.example .env
    
    # Выставляем права ОДИН РАЗ при сборке
    RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
    
    # Создаем пустой лог-файл для PHP-FPM и даем на него права
    RUN touch /var/log/fpm-php.www.log && chown www-data:www-data /var/log/fpm-php.www.log
    
    # === ГЛАВНОЕ ИЗМЕНЕНИЕ: ИСПРАВЛЯЕМ ГЛОБАЛЬНЫЙ КОНФИГ PHP-FPM ===
    RUN sed -i 's#error_log = /proc/self/fd/2#error_log = /var/log/fpm-php.www.log#' /usr/local/etc/php-fpm.conf
    
    # Создаем кэш для продакшена
    RUN php artisan config:cache && \
        php artisan route:cache && \
        php artisan view:cache
    
    # Запускаем все через supervisor
    CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]