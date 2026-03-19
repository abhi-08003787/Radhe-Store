#!/bin/bash

# Laravel Build Script for Render Deployment
set -e

echo "🚀 Starting Laravel build process..."

# Install Composer dependencies (production only)
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Cache Laravel configuration
echo "⚙️ Caching Laravel configuration..."
php artisan config:cache

# Cache Laravel routes
echo "🛣️ Caching Laravel routes..."
php artisan route:cache

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm install

# Build frontend assets
echo "🏗️ Building frontend assets..."
npm run build

# Create storage link if not exists
echo "🔗 Creating storage link..."
php artisan storage:link

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache

echo "✅ Build completed successfully!"
