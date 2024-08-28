FROM php:8.2-fpm

# Cài đặt các gói cần thiết và Imagick
RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends && \
    pecl install imagick && \
    docker-php-ext-enable imagick && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài đặt Nginx
RUN apt-get update && apt-get install -y nginx

# Xóa tệp mặc định của Nginx
RUN rm /etc/nginx/nginx.conf

# Sao chép tệp cấu hình Nginx tùy chỉnh
COPY nginx.conf /etc/nginx/nginx.conf

# Mở cổng 80
EXPOSE 80

# Khởi động Nginx và PHP-FPM
CMD ["nginx", "-g", "daemon off;"]



# FROM php:8.1.0-apache
# WORKDIR /var/www/html

# Mod Rewrite
RUN a2enmod rewrite

# Linux Library
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev 

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP Extension
RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd