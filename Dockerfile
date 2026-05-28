FROM wordpress:php8.2-apache

RUN apt-get update && apt-get install -y \
    nano \
    vim \
    unzip \
    zip \
    curl \
    default-mysql-client

RUN a2enmod rewrite headers expires

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80