#!/bin/sh

# Создаем нужные директории, если их нет
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs

# Выставляем правильные права (делаем это при каждом старте для надежности)
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Выполняем миграции и оптимизацию (хорошая практика для продакшена)
# php artisan migrate --force  # Раскомментируйте, если хотите авто-миграции при старте

# Очищаем кэши, как вы и делали
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Запускаем PHP-FPM в фоновом режиме
php-fpm &

# Запускаем Nginx на переднем плане (чтобы контейнер не завершился)
nginx -g 'daemon off;'