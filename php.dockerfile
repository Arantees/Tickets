FROM php:8.2-fpm

RUN set -ex && \
    apt update && \
    apt install -y \ 
    libpq-dev \
    postgresql

RUN docker-php-ext-install pdo_pgsql
