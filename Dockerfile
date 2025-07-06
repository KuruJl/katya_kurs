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

# ... (установка nginx, supervisor, php-ext) ...
RUN apk add --no-cache nginx supervisor sed
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# ... (копирование файлов) ...
COPY --from=vendor /app/vendor/ ./vendor/
COPY --from=frontend /app/public/ ./public/
COPY . .
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY .docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY .docker/nginx.conf /etc/nginx/nginx.conf
COPY .env.example .env

# === НОВЫЙ БЛОК ДЛЯ ПРАВ И ЛОГОВ ===
# Выставляем права на папки
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
# Создаем пустой лог-файл для FPM
RUN touch /var/log/fpm-php.www.log && chown www-data:www-data /var/log/fpm-php.www.log
# ---> ДОБАВЬТЕ ЭТУ СТРОКУ <---
# Принудительно создаем пустой лог-файл для Laravel
RUN touch /var/www/html/storage/logs/laravel.log && chown www-data:www-data /var/www/html/storage/logs/laravel.log

# Исправляем глобальный конфиг PHP-FPM
RUN sed -i 's#error_log = /proc/self/fd/2#error_log = /var/log/fpm-php.www.log#' /usr/local/etc/php-fpm.conf

# Создаем кэш
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Запускаем все через supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]