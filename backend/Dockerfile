# Stage 1: Composer
FROM composer:latest AS composer

WORKDIR /app

# Copy only the necessary files for dependency resolution
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader && rm -rf /root/.composer

# Stage 2: PHP
FROM php:8.1

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copy the application files
COPY . .

# Copy the vendor directory from the Composer stage
COPY --from=composer /app/vendor ./vendor

RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=8000
