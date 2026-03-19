FROM php:8.2-apache

# 1. જરૂરી સિસ્ટમ પેકેજ ઇન્સ્ટોલ કરો
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. Apache rewrite મોડ્યુલ ચાલુ કરો
RUN a2enmod rewrite

# 3. કામ કરવાની જગ્યા સેટ કરો
WORKDIR /var/www/html

# 4. બધી ફાઈલો કોપી કરો
COPY . .

# 5. Apache ને લારાવેલના public ફોલ્ડર પર સેટ કરો
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. આ લાઈન ખાસ ઉમેરો: ખાલી ફોલ્ડર્સ બનાવવા માટે
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache

# 7. પરમિશન સેટ કરો (હવે એરર નહીં આવે)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 8. Composer ઇન્સ્ટોલ કરો
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

EXPOSE 80
