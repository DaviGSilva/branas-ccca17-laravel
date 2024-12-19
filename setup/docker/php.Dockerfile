FROM php:8.4-fpm

WORKDIR /var/www/html

RUN apt update \
  && apt install --quiet --yes --no-install-recommends  \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

RUN pecl install -o -f redis-6.1.0 \
    && pecl install xdebug-3.4.0 \
    && docker-php-ext-enable redis xdebug

# Latest release
COPY --from=composer/composer /usr/bin/composer /usr/bin/composer

RUN groupadd --gid 1000 appuser \
    && useradd --uid 1000 -g appuser \
    -G www-data,root --shel /bin/bash \
    --create-home appuser

USER appuser
