FROM php:8.2-fpm

RUN apt-get update && apt install bash \
	vim -y

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql


WORKDIR /var/www
COPY . .

COPY --from=composer /usr/bin/composer /usr/bin/composer