# Эта строка ОБЯЗАТЕЛЬНО должна быть самой первой!
# Она включает современный движок сборки (BuildKit).
#syntax=docker/dockerfile:1

# --- ЭТАП 1: Установка PHP зависимостей ('vendor') ---
    FROM composer:2 as vendor
    WORKDIR /app
    # Копируем только то, что нужно для установки зависимостей
    COPY database/ database/
    COPY composer.json composer.json
    COPY composer.lock composer.lock
    RUN composer install \
        --ignore-platform-reqs \
        --no-interaction \
        --no-plugins \
        --no-scripts \
        --prefer-dist
    
    # --- ЭТАП 2: Сборка фронтенда ('frontend') ---
    FROM node:18-alpine as frontend
    WORKDIR /app
    # Копируем файлы для сборки фронтенда
    COPY package.json package-lock.json ./
    RUN npm ci
    COPY . .
    RUN npm run build
    
    # --- ЭТАП 3: Финальный образ для продакшена ---
    FROM php:8.2-fpm-alpine
    
    # Устанавливаем системные пакеты
    RUN apk add --no-cache nginx
    
    # Устанавливаем PHP расширения
    RUN docker-php-ext-install pdo pdo_mysql
    
    WORKDIR /var/www/html
    
    # Копируем собранные зависимости и фронтенд с предыдущих этапов
    COPY --from=vendor /app/vendor/ ./vendor/
    COPY --from=frontend /app/public/ ./public/
    
    # Копируем остальной код приложения (все, что не указано в .dockerignore)
    COPY . .
    
    # Копируем конфигурации и делаем скрипт исполняемым
    COPY .docker/www.conf /usr/local/etc/php-fpm.d/www.conf  
    COPY .docker/nginx.conf /etc/nginx/nginx.conf
    COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
    RUN chmod +x /usr/local/bin/entrypoint.sh
    
    # Выставляем правильные права на папки (после того, как все файлы скопированы)
    RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
    
    # Запускаем наш скрипт
    CMD ["entrypoint.sh"]