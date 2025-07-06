#syntax=docker/dockerfile:1

# --- ЭТАП 1: vendor ---
    FROM composer:2 as vendor
    # ... (этот этап не меняется) ...
    WORKDIR /app
    COPY database/ database/
    COPY composer.json composer.json
    COPY composer.lock composer.lock
    RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts --prefer-dist
    
    # --- ЭТАП 2: frontend ---
    FROM node:18-alpine as frontend
    # ... (этот этап не меняется) ...
    WORKDIR /app
    COPY package.json package-lock.json ./
    RUN npm ci
    COPY . .
    RUN npm run build
    
    # --- ЭТАП 3: Финальный образ ---
    FROM php:8.2-fpm-alpine
    
    # Устанавливаем Nginx И SUPERVISOR
    RUN apk add --no-cache nginx supervisor
    
    # Устанавливаем PHP расширения
    RUN docker-php-ext-install pdo pdo_mysql
    
    WORKDIR /var/www/html
    
    # Копируем артефакты с предыдущих этапов
    COPY --from=vendor /app/vendor/ ./vendor/
    COPY --from=frontend /app/public/ ./public/
    COPY . .
    
    # Копируем ВСЕ конфигурации
    COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
    COPY .docker/www.conf /usr/local/etc/php-fpm.d/www.conf
    COPY .docker/nginx.conf /etc/nginx/nginx.conf
    
    # Выставляем права ОДИН РАЗ при сборке
    RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
    
    # Очищаем кэш и прочее. Мы можем это сделать здесь, т.к. файлы уже на месте
    RUN php artisan config:clear && \
        php artisan route:clear && \
        php artisan view:clear && \
        php artisan cache:clear
    
    # НОВАЯ КОМАНДА ЗАПУСКА
    CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]