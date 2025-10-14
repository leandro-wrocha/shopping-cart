FROM php:8.4-fpm-alpine AS app-dev

RUN apk update && apk upgrade && apk add --no-cache curl bash shadow
RUN docker-php-ext-install opcache

# install php extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions
RUN install-php-extensions xdebug pdo pdo_mysql mysqli bcmath zip

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# copy xdebug config
# COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# expose ports for nginx
EXPOSE 9000

# create a non-root user to run our application
RUN adduser -D -u 1000 phpuser && mkdir -p /var/www && chown -R phpuser:phpuser /var/www
USER phpuser

WORKDIR /var/www

CMD ["php-fpm"]
