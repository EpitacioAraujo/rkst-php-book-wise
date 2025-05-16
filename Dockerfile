# Use the PHP 8.2 official image
FROM php:8.2-cli

# Install system dependencies and install Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /app
WORKDIR /app

# Copy application files from ./src to /app
COPY . .

# Install project dependencies (if there's a composer.json in ./src)
# RUN composer install --no-interaction --prefer-dist

# Expose the default PHP port
EXPOSE 8000

# Start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app/src/public"]
