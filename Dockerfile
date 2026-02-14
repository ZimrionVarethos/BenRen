FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    ca-certificates \
    libonig-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    zlib1g-dev \
    pkg-config \
    gnupg \
    build-essential \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo mbstring zip exif pcntl bcmath gd xml

# Install pecl extensions (mongodb)
RUN apt-get update && apt-get install -y libssl-dev && pecl install mongodb && docker-php-ext-enable mongodb && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# node 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Create working directory
WORKDIR /var/www/html

# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy package files and install node deps
COPY package.json package-lock.json ./
RUN npm ci --silent

# Copy the rest of the application
COPY . .

# Build assets
RUN npm run build

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# Expose port (Render provides $PORT at runtime)
EXPOSE 8080

# Default command — use PORT env if set by Render
CMD ["sh", "-lc", "php artisan migrate --force || true; php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
