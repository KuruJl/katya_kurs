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

echo "--- Waiting for database to be ready ---"
# Цикл будет работать, пока команда nc не вернет успешный результат (код 0)
# -z: просто проверить, открыт ли порт, не отправляя данные
# -w2: таймаут 2 секунды на попытку
while ! nc -z -w2 $DB_HOST $DB_PORT; do
  echo "Database is unavailable - sleeping"
  sleep 2
done
echo "--- Database is ready! ---"


# 2. Выполняем миграции БД (теперь они точно сработают)
echo "--- Running migrations ---"
php artisan migrate --force
echo "--- Migrations complete ---"

# 3. Запускаем PHP-FPM в фоновом режиме
php-fpm &

# 4. Запускаем Nginx на переднем плане.
# Эта команда будет удерживать контейнер "живым".
echo "--- Starting Nginx ---"
nginx -g "daemon off;"