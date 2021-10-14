FROM php:8.0-cli
COPY . /var/www/html
WORKDIR /var/www/html

RUN apt-get update && apt-get upgrade -y

# Install Git
RUN apt-get install -y git

# Install PHP EXT
RUN php -r "print_r(openssl_get_cert_locations());"

RUN apt-get install -y --no-install-recommends gnupg wget libssl-dev zlib1g-dev curl unzip netcat libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu && \
    pecl install xdebug-3.0.0 && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
    docker-php-ext-enable apcu pdo_pgsql sodium xdebug && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install composer dependencies and run phpunit test
CMD bash -c "composer install -o && php -r 'while (true) sleep(60);'"