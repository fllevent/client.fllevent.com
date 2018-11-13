FROM php:7.2-apache
RUN a2enmod rewrite
COPY rest.conf /etc/apache2/sites-enabled/000-default.conf
COPY app/ /var/www/html/
EXPOSE 80