# Sử dụng image PHP 8.2 kèm Apache (bạn có thể đổi thành 8.1 hoặc 8.3 tùy dự án)
FROM php:8.2-apache

# Cài đặt các thư viện hệ thống cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl libpq-dev libonig-dev nodejs npm \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring gd

# Bật mod_rewrite của Apache (bắt buộc cho routing của Laravel)
RUN a2enmod rewrite

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ code vào container
COPY . .

# Cài đặt các package của PHP và Frontend (Vite)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Cấp quyền ghi cho storage và cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Trỏ DocumentRoot của Apache vào thư mục /public của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Render sẽ tự động map port 80 này
EXPOSE 80

# Chạy file script khởi động
COPY start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start
CMD ["start"]
