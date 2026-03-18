# Use the official PHP 8.3 Apache image
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    pdo \
    mbstring \
    exif \
    bcmath \
    xml \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Clear Composer cache
RUN composer clear-cache

# Copy composer.lock and composer.json
COPY composer.lock composer.json ./

# Install dependencies
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# Copy existing application directory contents
COPY . .

# Copy .env.example to .env
RUN cp .env.example .env

# Create storage link and set permissions
RUN php artisan key:generate \
    && php artisan storage:link \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Install Node dependencies and build assets
RUN npm install \
    && npm run build

# Expose port 80
EXPOSE 80

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Start Apache
CMD ["apache2-foreground"]
