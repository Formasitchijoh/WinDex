#!/bin/bash
# Wait for Postgres to be ready
for i in {1..30}; do
    if php -r "try { new PDO('pgsql:host=db;port=5432;dbname=windex', 'root', 'password'); exit(0); } catch (Exception \$e) { exit(1); }" 2>/dev/null; then
        echo "Postgres is ready!"
        break
    fi
    echo "Waiting for Postgres..."
    sleep 2
done

# Run migrations and seeding
php artisan migrate --force
php artisan db:seed --force --class=BrandSeeder
php artisan serve --host=0.0.0.0 --port=$PORT