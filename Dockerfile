FROM php:8.2-cli

WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# Install dependencies
RUN composer install

# Generate key & storage link
RUN php artisan key:generate
RUN php artisan storage:link

# Serve app
CMD php artisan serve --host=0.0.0.0 --port=10000