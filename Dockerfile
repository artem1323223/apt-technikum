FROM php:8.2-fpm

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Установка Nginx и Supervisor
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    curl \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Копируем файлы проекта
COPY . /var/www/html

# Копируем конфиг Nginx
COPY nginx/default.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Настройка прав
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Создаем директории для загрузок
RUN mkdir -p /var/www/html/uploads/students \
    && mkdir -p /var/www/html/uploads/teachers \
    && chmod -R 777 /var/www/html/uploads

# Конфигурация Supervisor
RUN echo '[supervisord]' > /etc/supervisor/conf.d/supervisord.conf
RUN echo 'nodaemon=true' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'user=root' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo '' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo '[program:nginx]' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'command=/usr/sbin/nginx -g "daemon off;"' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stdout_logfile=/dev/stdout' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stdout_logfile_maxbytes=0' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stderr_logfile=/dev/stderr' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stderr_logfile_maxbytes=0' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo '' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo '[program:php-fpm]' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'command=/usr/local/sbin/php-fpm -F' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stdout_logfile=/dev/stdout' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stdout_logfile_maxbytes=0' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stderr_logfile=/dev/stderr' >> /etc/supervisor/conf.d/supervisord.conf
RUN echo 'stderr_logfile_maxbytes=0' >> /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord"]
