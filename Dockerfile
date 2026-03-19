FROM php:8.2-fpm

# Install system dependencies including libjpeg and freetype
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure and install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql mbstring exif pcntl bcmath xml zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Copy .env.example to .env and generate key
RUN cp .env.example .env

# Install composer dependencies with platform reqs ignored
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Laravel optimization
RUN php artisan config:cache \
    && php artisan route:cache

EXPOSE 9000
CMD ["php-fpm"]
