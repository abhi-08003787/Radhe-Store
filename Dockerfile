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

# Copy .env.example to .env and ensure it exists
RUN cp .env.example .env || true

# Set dummy environment variables to prevent Laravel from failing
ENV APP_KEY=base64:uS68761H966H966H966H966H966H966H966H966H=
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=:memory:

# Install composer dependencies with platform reqs ignored and no scripts
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

# Run scripts safely
RUN php artisan package:discover --ansi || true
RUN php artisan config:clear || true

# Generate app key if missing
RUN php artisan key:generate || true

# Laravel optimization
RUN php artisan config:cache \
    && php artisan route:cache

# Set correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
