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
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install \
    intl \
    mbstring \
    mysqli \
    pdo_mysql \
    xml \
    zip

WORKDIR /var/www/html

# Clean up build artifacts and move the rest
COPY . /var/www/html
COPY --from=vendor /app/vendor /var/www/html/vendor

RUN chown -R www-data:www-data /var/www/html/writable /var/www/html/public

EXPOSE 9000
CMD ["php-fpm"]
