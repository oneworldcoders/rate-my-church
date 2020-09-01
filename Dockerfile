FROM php:7.4-cli

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpq-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /usr/src/myapp

WORKDIR /usr/src/myapp
ADD composer.json /usr/src/myapp/composer.json
ADD composer.lock /usr/src/myapp/composer.lock
ADD . /usr/src/myapp
RUN composer install --prefer-source --no-interaction
CMD php artisan serve --host '0.0.0.0' --port $PORT

