# Sử dụng PHP 8.2 làm base image

FROM php:8.2-fpm

# Cài đặt các gói cần thiết
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip


# Thiết lập thư mục làm việc

WORKDIR /var/www/html

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Sao chép mã nguồn ứng dụng Laravel vào container
COPY . /var/www/html

# Cài đặt các dependency của Laravel bằng Composer
RUN composer install

# Phân quyền cho thư mục storage của Laravel
RUN chown -R www-data:www-data /var/www/html/storage

# Expose cổng mặc định của PHP-FPM
EXPOSE 9000

# CMD để khởi động PHP-FPM
CMD ["php-fpm"]
