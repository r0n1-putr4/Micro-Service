FROM php:latest
WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_mysql mysqli
EXPOSE 3001
CMD [ "php", "-S", "0.0.0.0:3001", "-t", "public" ]
