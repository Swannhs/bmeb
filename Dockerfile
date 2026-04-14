FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-progress \
    --ignore-platform-reqs


FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libonig-dev \
        unzip \
    && docker-php-ext-install intl mbstring \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . /var/www/html
COPY --from=vendor /app/vendor /var/www/html/vendor

RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf \
    && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n\n<IfModule mod_dir.c>\n    DirectorySlash Off\n</IfModule>\n' > /etc/apache2/conf-available/codeigniter.conf \
    && a2enconf codeigniter \
    && chown -R www-data:www-data /var/www/html/writable /var/www/html/public

EXPOSE 80
