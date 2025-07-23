#!/bin/bash

echo "Starting Laravel build process for Vercel..."

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate --force

# Create SQLite database
touch /tmp/database.sqlite

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build process completed!"
