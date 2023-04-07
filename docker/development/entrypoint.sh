#!/usr/bin/env bash
composer update

npm install
rm -rf node_modules
npm install
npm run build
php artisan migrate

service nginx start
php-fpm
