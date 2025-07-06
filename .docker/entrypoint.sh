#!/bin/sh
set -e

# 1. Подготовка папки storage (как мы уже убедились, это работает)
echo "--- Initializing storage volume ---"
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs
touch /var/www/html/storage/logs/laravel.log
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
echo "--- Storage initialized ---"

# 2. Выполняем миграции БД (это хорошая практика)
# Если у вас еще нет БД, закомментируйте следующую строку
php artisan migrate --force

# 3. Запускаем PHP-FPM в фоновом режиме
php-fpm &

# 4. Запускаем Nginx на переднем плане.
# Эта команда будет удерживать контейнер "живым".
echo "--- Starting Nginx ---"
nginx -g "daemon off;"