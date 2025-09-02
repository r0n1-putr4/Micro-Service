FROM php:8.2-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
EXPOSE 3003
CMD [ "php", "-S", "0.0.0.0:3003", "-t", "public" ]