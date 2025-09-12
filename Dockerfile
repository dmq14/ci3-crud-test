# PHP 7.4 + Apache
FROM php:7.4-apache

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Enable mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess override
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/allowoverride.conf \
    && a2enconf allowoverride

# Fix ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Change Apache listen port to 10000 (Render free plan)
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' /etc/apache2/sites-enabled/000-default.conf

# Copy CI3 code into container
COPY . /var/www/html/

# Create cache/logs folders and set permissions
RUN mkdir -p /var/www/html/application/cache /var/www/html/application/logs \
    && chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs

# Install Composer
RUN apt-get update && apt-get install -y unzip curl git \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Run composer install in production mode (skip dev & scripts)
USER www-data
RUN cd /var/www/html && composer install --no-dev --no-scripts --optimize-autoloader
USER root

# Expose port for Render
EXPOSE 10000

# Start Apache
CMD ["apache2-foreground"]
