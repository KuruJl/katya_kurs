#!/bin/sh
# Прекратить выполнение при любой ошибке
set -e

# Этот скрипт запускается каждый раз при старте контейнера
# и идеально подходит для инициализации персистентных томов.

echo "--- Initializing storage volume ---"

# Создаем все необходимые директории Laravel, если их нет
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs

# Создаем сам лог-файл, если его нет
touch /var/www/html/storage/logs/laravel.log

# Выставляем правильные права на всю папку storage и bootstrap/cache
# Это нужно делать здесь, так как том монтируется с правами root
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "--- Initialization complete. Handing over to CMD. ---"

# Эта команда выполняет то, что указано в CMD вашего Dockerfile
# (в нашем случае, она запустит supervisord)
exec "$@"