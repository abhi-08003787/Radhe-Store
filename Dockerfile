FROM php:8.2-apache

# સિસ્ટમ ડિપેન્ડન્સી
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip unzip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache સેટઅપ
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Apache ને બળજબરીથી જણાવવું કે index.php ક્યાં છે
RUN echo 'DirectoryIndex index.php index.html' > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php && a2enmod rewrite

# Composer મેળવો
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ફાઈલો કોપી કરો (ખાતરી કરો કે 'public' કોપી થાય છે)
COPY . .

# જરૂરી ડિરેક્ટરીઓ બનાવવી અને પરમિશન
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# ડિપેન્ડન્સી ઇન્સ્ટોલ
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

EXPOSE 80