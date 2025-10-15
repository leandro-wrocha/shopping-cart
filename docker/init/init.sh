#!/bin/sh
set -e

# create .env file from environment variables
rm -f /var/www/.env
printenv > /var/www/.env

# start the PHP-FPM
exec php-fpm
