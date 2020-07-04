FROM php:7.4-apache
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql
RUN a2enmod rewrite
COPY docker/apache-site.conf /etc/apache2/sites-enabled/000-default.conf
