FROM php:8.2-apache

# 1. System dependencies અને PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Apache Configuration - આ ભાગ સૌથી મહત્વનો છે
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# DocumentRoot બદલો
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Apache ને કહો કે index.php જ મેઈન ફાઈલ છે
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# 3. Enable Apache ModRewrite
RUN a2enmod rewrite

# 4. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# પેહલા બધી ફાઈલો કોપી કરો
COPY . .

# 5. જરૂરી ડિરેક્ટરીઓ બનાવવી અને પરમિશન સેટ કરવી
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN mkdir -p /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/storage/framework/cache \
             /var/www/html/bootstrap/cache

# 6. Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

EXPOSE 80