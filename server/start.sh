#!/bin/bash
# Wait for MySQL to be ready (simple delay for reliability)
for i in {1..30}; do
    if php -r "try { new PDO('mysql:host=db;dbname=windex', 'root', 'password'); exit(0); } catch (Exception \$e) { exit(1); }" 2>/dev/null; then
        echo "MySQL is ready!"
        break
    fi
    echo "Waiting for MySQL..."
    sleep 2
done

# Run migrations and seeding
php artisan migrate --force
php artisan db:seed --force --class=BrandSeeder
php-fpm