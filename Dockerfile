FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html

COPY www/ /var/www/html/

RUN mkdir -p /var/www/html/uploads/students /var/www/html/uploads/teachers && chmod -R 777 /var/www/html/uploads

EXPOSE 9000

CMD php -S 0.0.0.0:9000 -t /var/www/html
