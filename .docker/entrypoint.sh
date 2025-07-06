#!/bin/sh
set -e

echo "======================================================"
echo "--- STARTING ULTIMATE DIAGNOSTIC SCRIPT ---"
echo "======================================================"
echo "Current user: $(whoami)"
echo "Working directory: $(pwd)"
echo ""

echo "--- 1. STATE OF '/var/www/html/storage' BEFORE ANY ACTION ---"
# Рекурсивно показываем все содержимое папки storage
ls -laR /var/www/html/storage || echo "!!! DIRECTORY /var/www/html/storage DOES NOT EXIST !!!"
echo ""

echo "--- 2. ATTEMPTING TO CREATE DIRECTORIES AND FILE ---"
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs
echo "mkdir commands executed."

touch /var/www/html/storage/logs/laravel.log
echo "touch command for laravel.log executed."
echo ""

echo "--- 3. STATE OF '/var/www/html/storage' AFTER ACTIONS ---"
# Снова рекурсивно показываем все содержимое
ls -laR /var/www/html/storage || echo "!!! DIRECTORY /var/www/html/storage STILL DOES NOT EXIST !!!"
echo ""

echo "--- 4. ATTEMPTING TO 'cat' THE FILE WE JUST CREATED ---"
cat /var/www/html/storage/logs/laravel.log || echo "!!! CAT FAILED - laravel.log NOT FOUND !!!"
echo "(If you see nothing above this line, 'cat' worked on an empty file)"
echo ""

echo "======================================================"
echo "--- DIAGNOSTIC SCRIPT FINISHED. SLEEPING. ---"
echo "======================================================"

# Мы не запускаем supervisord, чтобы ничего не мешало диагностике.
# Контейнер просто будет работать 10 минут.
sleep 600