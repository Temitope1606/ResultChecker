# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Ensure the Apache server runs on port 80
EXPOSE 80

RUN docker-php-ext-install mysqli
