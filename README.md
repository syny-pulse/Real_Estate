# Real_Estate
Group I real estate management system using Laravel and Php

Install git clone https://github.com/syny-pulse/Real_Estate.git 
cd real-estate
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve