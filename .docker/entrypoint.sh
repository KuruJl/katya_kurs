#!/bin/sh
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
# Запускаем PHP-FPM в фоновом режиме
php-fpm &

# Запускаем Nginx на переднем плане (чтобы контейнер не завершился)
nginx -g 'daemon off;'