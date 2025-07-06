#!/bin/sh

# Это отладочный скрипт. Он выведет информацию и будет работать 10 минут.
set -e # Прекратить выполнение при первой ошибке

echo "--- STARTING DEBUG SCRIPT ---"

echo "Current user: $(whoami)"
echo "Current directory: $(pwd)"

echo "Listing contents of /var/www/html:"
ls -la /var/www/html

echo "Listing contents of /var/www/html/storage:"
ls -la /var/www/html/storage || echo "Storage directory does not exist."

echo "--- TRYING TO CREATE LOGS DIRECTORY AND FILE ---"
mkdir -p /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/storage
touch /var/www/html/storage/logs/test.log
echo "Test log file created."

echo "Listing contents of /var/www/html/storage/logs again:"
ls -la /var/www/html/storage/logs

echo "--- DEBUG SCRIPT FINISHED, SLEEPING FOR 600 SECONDS ---"
sleep 600