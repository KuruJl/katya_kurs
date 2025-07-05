# Этап 1: Установка PHP зависимостей с помощью Composer
FROM composer:2 as vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Этап 2: Сборка фронтенда с помощью Node.js
FROM node:18-alpine as frontend

WORKDIR /app
COPY . .
RUN npm ci && npm run build

# Этап 3: Финальный образ для продакшена с Nginx и PHP-FPM
FROM php:8.2-fpm-alpine

# Устанавливаем системные пакеты: Nginx и утилиты
RUN apk add --no-cache nginx

# Устанавливаем необходимые PHP расширения
RUN docker-php-ext-install pdo pdo_mysql

# Копируем код приложения и собранные зависимости
WORKDIR /var/www/html
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
COPY --from=frontend /app/public/ /var/www/html/public/
COPY . .

# Копируем нашу конфигурацию Nginx
COPY .docker/nginx.conf /etc/nginx/nginx.conf

# Выставляем правильные права на папки
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Запускаем Nginx. Railway сам предоставит порт ${PORT}
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]