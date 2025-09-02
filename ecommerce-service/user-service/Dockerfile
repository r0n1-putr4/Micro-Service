FROM php:8.2-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
EXPOSE 3001
CMD [ "php", "-S", "0.0.0.0:3001", "-t", "public" ]