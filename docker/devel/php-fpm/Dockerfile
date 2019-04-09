FROM php:7.3-fpm-stretch

ARG COMPOSER_VERSION=1.6.3


RUN apt-get update; \
    apt-get install -y git libpq-dev; \
    pecl install redis; \
    docker-php-ext-enable redis;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION};

WORKDIR /app
