FROM php:8.4-fpm-alpine AS app-dev

RUN apk update && apk upgrade && apk add --no-cache curl bash shadow nano
RUN docker-php-ext-install opcache

# install php extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions
RUN install-php-extensions xdebug pdo pdo_mysql mysqli zip

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# copy xdebug config
# COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# configure php-fpm to run as non-root user
RUN sed -i 's/^user = .*/user = phpuser/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/^group = .*/group = phpuser/' /usr/local/etc/php-fpm.d/www.conf

# copy init script
COPY ./docker/init/init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

# expose ports for nginx
EXPOSE 9000

# create a non-root user to run our application
RUN adduser -D -u 1000 phpuser && mkdir -p /var/www && chown -R phpuser:phpuser /var/www
USER phpuser

WORKDIR /var/www

ENTRYPOINT [ "/usr/local/bin/init.sh" ]
