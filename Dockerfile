FROM php:8.2-fpm

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Дополнительные настройки
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
