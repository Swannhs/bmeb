# Build phase
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-progress \
    --ignore-platform-reqs

# Runtime phase
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    sqlite-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-source extract \
    && cp /usr/src/php/ext/sqlite3/config0.m4 /usr/src/php/ext/sqlite3/config.m4 \
    && docker-php-ext-install \
    intl \
    mbstring \
    pdo_sqlite \
    sqlite3 \
    xml \
    zip \
    && docker-php-source delete

WORKDIR /var/www/html

# Clean up build artifacts and move the rest
COPY . /var/www/html
COPY --from=vendor /app/vendor /var/www/html/vendor

RUN chown -R www-data:www-data /var/www/html/writable /var/www/html/public

EXPOSE 9000
CMD ["php-fpm"]
