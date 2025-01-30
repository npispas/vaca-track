FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    unzip \
    git

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

RUN npm install -g npm@11.1.0

RUN node -v && npm -v

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000