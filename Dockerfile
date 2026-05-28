FROM wordpress:php8.2-apache

RUN apt-get update && apt-get install -y \
    nano \
    vim \
    unzip \
    zip \
    curl \
    default-mysql-client && \
    apt-get clean

RUN a2enmod rewrite headers expires

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy PHP config
COPY config/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Copy WordPress config
COPY config/wp-config.php /usr/src/wordpress/wp-config.php

EXPOSE 80