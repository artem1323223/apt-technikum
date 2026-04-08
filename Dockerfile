FROM php:8.2-fpm

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Установка Nginx
RUN apt-get update && apt-get install -y nginx && rm -rf /var/lib/apt/lists/*

# Копируем файлы проекта
COPY . /var/www/html

# Копируем конфиг Nginx
COPY nginx/default.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Настройка прав
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Создаем директории для загрузок
RUN mkdir -p /var/www/html/uploads/students /var/www/html/uploads/teachers && chmod -R 777 /var/www/html/uploads

# Запускаем Nginx и PHP-FPM
CMD service nginx start && php-fpm
