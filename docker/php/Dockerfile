FROM php:7.4-fpm-alpine

LABEL maintainer="Vitaly Kopytich"

# Copy application files to contaier
COPY . /var/www/

# Install PDO
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install composer and make command global
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set property permissions to files
RUN chown -R www-data:www-data /var/www

WORKDIR /var/www
