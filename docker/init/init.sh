#!/bin/sh
set -e

# create .env file from environment variables
rm -f /var/www/.env
printenv > /var/www/.env

# try to set ownership and permissions so UID 1000 and GID 101 can access /var/www
# we ignore errors to avoid failing when the container is not running as root or
# when the volume is managed by the host and cannot be changed from inside.
if [ -d /var/www ]; then
	chown -R 1000:101 /var/www || true
	chmod -R g+rwX /var/www || true
	# setgid on directories so new files inherit the group
	find /var/www -type d -exec chmod g+s {} \; || true
fi

# start the PHP-FPM
exec php-fpm
