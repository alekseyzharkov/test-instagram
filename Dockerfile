FROM composer:2.2.5 as composer

FROM php:8.1-fpm

RUN apt update --no-install-recommends && apt install -y \
    git \
    openssh-client \
    unzip \
    libc-client-dev \
    libkrb5-dev \
    libonig-dev && \
    rm -r /var/lib/apt/lists/*

RUN docker-php-ext-install mbstring

WORKDIR /src

COPY contrib/php.ini $PHP_INI_DIR/conf.d/php.ini

COPY composer.json composer.lock ./

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.* ./
RUN composer install --no-scripts --no-autoloader --no-interaction --no-dev

COPY . ./
RUN composer install --no-scripts --no-autoloader --no-interaction --dev && \
    composer dump-autoload --optimize
