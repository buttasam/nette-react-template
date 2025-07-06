FROM php:8.2-cli

# Install PHP extensions and system dependencies
RUN set -ex \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        ca-certificates \
        gnupg \
        libzip-dev \
        libicu-dev \
        libpng-dev \
        libssl-dev \
        unzip \
        git \
        lsb-release \
    && docker-php-ext-configure ftp --with-openssl-dir=/usr \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mysqli \
        intl \
        gd \
        ftp

# Install latest Node.js (LTS) and npm using NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app