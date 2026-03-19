FROM php:8.2-apache

# 1. જરૂરી PHP Extensions ઇન્સ્ટોલ કરો
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

# 2. Apache Configuration - આ PHP કોડને રન કરવા માટે જરૂરી છે
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# PHP ફાઈલોને રન કરવા માટેનું સેટિંગ
RUN printf '<FilesMatch "\\.php$">\n\tSetHandler application/x-httpd-php\n</FilesMatch>\n' > /etc/apache2/conf-available/php-config.conf \
    && a2enconf php-config

# 3. Apache Modules ઇનેબલ કરો
RUN a2enmod rewrite

# 4. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 5. બધી ફાઈલો કોપી કરો
COPY . .

# 6. Laravel માટે જરૂરી ફોલ્ડર્સ અને પરમિશન
RUN mkdir -p storage/framework/sessions \
             storage/framework/views \
             storage/framework/cache \
             bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 7. Dependencies ઇન્સ્ટોલ કરો
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

EXPOSE 80