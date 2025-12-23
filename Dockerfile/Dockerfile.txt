FROM php:8.2-apache

# Enable Apache rewrite (important even for plain PHP)
RUN a2enmod rewrite

# Install MySQL extension for PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files to Apache web root
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
