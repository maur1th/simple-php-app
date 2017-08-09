FROM php:7.1-fpm

RUN docker-php-ext-install mysqli
COPY src/ /var/www/html/
