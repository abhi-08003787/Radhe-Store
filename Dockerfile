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

# Set environment variables
ENV APP_KEY=base64:uS68761H966H966H966H966H966H966H966H=
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=:memory:
ENV APP_DEBUG=false
ENV APP_ENV=production

# Install composer dependencies with platform reqs ignored and no scripts
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

# Run scripts safely
RUN php artisan package:discover --ansi || true
RUN php artisan config:clear || true

# Generate app key if missing
RUN php artisan key:generate || true

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
