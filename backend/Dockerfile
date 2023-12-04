# Use the official PHP image as the base image
FROM php:8.1.0-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the application files to the container
COPY . /var/www/html

# Install dependencies using Composer
RUN apt-get update -y && apt-get install -y \
        git \
        unzip \
        libzip-dev && \
    docker-php-ext-install zip pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-interaction --optimize-autoloader


# Set up Apache configurations (if necessary)
# ...

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]