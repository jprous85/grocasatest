FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
        gcc make autoconf libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev libxml++2.6-dev libicu-dev g++ libmcrypt-dev; \

        pecl config-set php_ini "${PHP_INI_DIR}/php.ini";\
        pecl install mcrypt-1.0.3 && docker-php-ext-enable mcrypt \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) intl bcmath mbstring exif gd

RUN apt-get install -y curl
RUN apt-get install -y git
RUN apt-get install -y unzip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN apt-get install -y wget

RUN apt-get install -y gnupg
RUN wget -qO - https://www.mongodb.org/static/pgp/server-4.4.asc | apt-key add -
RUN echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu bionic/mongodb-org/4.4 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-4.4.list
RUN apt-get update
RUN apt-get install -y mongodb-org
RUN composer require jenssegers/mongodb --ignore-platform-reqs

RUN apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt -y install nodejs

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt install -y yarn

COPY ./grocasatest.conf /etc/apache2/sites-available/

RUN a2dissite 000-default.conf; \
    a2enmod headers; \
    a2enmod rewrite; \
    a2ensite grocasatest.conf; \
    service apache2 restart;
