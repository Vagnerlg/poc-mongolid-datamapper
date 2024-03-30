FROM php:8.0-cli
RUN apt-get update -y && apt-get upgrade -y && apt-get install git libssl-dev zlib1g-dev libzip-dev unzip -y
RUN pecl install mongodb && docker-php-ext-enable mongodb && docker-php-ext-install zip
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini
COPY --from=composer:lts /usr/bin/composer /usr/bin/composer