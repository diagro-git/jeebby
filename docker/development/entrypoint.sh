#!/usr/bin/env bash
composer update

php artisan migrate

service nginx start
php-fpm
