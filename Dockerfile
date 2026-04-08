FROM php:8.2-cli

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Копируем файлы проекта
COPY . /var/www/html

# Создаем директории для загрузок
RUN mkdir -p /var/www/html/uploads/students /var/www/html/uploads/teachers && chmod -R 777 /var/www/html/uploads

WORKDIR /var/www/html

EXPOSE 9000

CMD php -S 0.0.0.0:9000 -t /var/www/html
