 # get php from docker hub
 FROM php:8.2.4-apache

#  COPY . /var/www/html

 RUN docker-php-ext-install pdo pdo_mysql
 RUN apt-get update && apt-get upgrade -y