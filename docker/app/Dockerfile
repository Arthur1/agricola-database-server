FROM php:7.4-fpm

WORKDIR /var/www

# timezone environment
ENV TZ=Asia/Tokyo \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

RUN apt update \
    && apt -y install \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install intl pdo_mysql zip bcmath
