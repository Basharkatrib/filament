#!/usr/bin/env bash
set -e  # توقف السكريبت فورًا إذا حدث خطأ

echo "Running composer install..."
composer install --no-dev --optimize-autoloader

echo "Generating application key..."
php artisan key:generate --force

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Linking storage..."
php artisan storage:link || true  # لا تفشل إذا كان الرابط موجودًا

echo "Running migrations..."
php artisan migrate --force

echo "Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Starting nginx & PHP-FPM..."
exec /start.sh
