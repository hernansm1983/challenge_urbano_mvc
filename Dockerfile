# Usamos la imagen oficial de PHP
FROM php:7.4-apache

# Habilitamos módulos de Apache y PHP necesarios
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli

# Copiamos los archivos de la aplicación al contenedor
COPY . /var/www/html/
