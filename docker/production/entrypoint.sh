#!/usr/bin/env bash
php artisan migrate --force
php artisan diagro:backend-token
php artisan diagro:rights

service nginx start
php-fpm
