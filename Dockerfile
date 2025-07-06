# Этап 3: Финальный образ для продакшена с Nginx и PHP-FPM
FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Копируем сначала composer.json и composer.lock, чтобы кэшировать зависимости
COPY composer.json composer.lock ./

# Копируем зависимости с этапа 'vendor'
COPY --from=vendor /app/vendor/ ./vendor/

# Копируем собранный фронтенд
COPY --from=frontend /app/public/ ./public/

# Копируем остальной код приложения (благодаря .dockerignore, мусор не попадет)
COPY . .

# Копируем конфигурацию Nginx и скрипт запуска
COPY .docker/nginx.conf /etc/nginx/nginx.conf
COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Выставляем правильные права на папки
# Важно: делаем это после того, как все файлы скопированы
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Запускаем наш скрипт
CMD ["entrypoint.sh"]