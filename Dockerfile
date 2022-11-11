FROM php:8.1-fpm-alpine

# Apk install
RUN apk --no-cache update && apk --no-cache add bash

## Install composer global
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install git global
RUN apk add --no-cache git

# Install ssh global
RUN apk add --no-cache openssh

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Set working directory
WORKDIR /var/www/html
