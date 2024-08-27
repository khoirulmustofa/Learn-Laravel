<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

```php

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan migrate:fresh --seed

php artisan db:seed


php artisan serve --port=8000


php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan clear-compiled
php artisan config:cache


php artisan optimize:clear

docker-compose up --build -d
docker-compose exec db /bin/bash

sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache



````
