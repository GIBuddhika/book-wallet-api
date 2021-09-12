FROM php:8.0-fpm-alpine

WORKDIR /var/www/html

RUN apk get update

RUN docker-php-ext-install pdo_mysql

RUN apk add npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup -g 1000 developer && adduser -G developer -g developer -s /bin/sh -D developer
 
USER developer

RUN chmod o+w ./storage/ -R

RUN php artisan key:generate
