# Dockerfile — fixed for Laravel + Node build (PHP 8.3 + Node 20)
FROM php:8.3-cli

ENV DEBIAN_FRONTEND=noninteractive
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www/html

# Install system deps + libssl for pecl + build tools
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
    libssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions (configure gd first)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo mbstring zip exif pcntl bcmath gd xml

# Install pecl extensions (mongodb)
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node 20 (no npm upgrade)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# ---------------------------
# Build steps (cache-friendly)
# ---------------------------

# 1) copy composer files for cache
COPY composer.json composer.lock ./

# 2) copy artisan + bootstrap so composer scripts can run
#    (this prevents "Could not open input file: artisan")
COPY artisan ./
COPY bootstrap ./bootstrap

# ensure artisan is executable (harmless if already is)
RUN chmod +x artisan || true

# 3) install php deps (will execute post-autoload scripts now that artisan exists)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress

# 4) copy package files and install node deps
COPY package.json package-lock.json ./
RUN npm ci --silent

# 5) copy the rest of the application
COPY . .

# 6) build frontend assets
RUN npm run build

# 7) set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# Expose & default command (use $PORT from host if provided)
EXPOSE 8080
CMD ["sh", "-lc", "php artisan migrate --force || true; php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
