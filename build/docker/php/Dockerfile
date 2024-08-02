FROM php:8.3-fpm
COPY php.ini /usr/local/etc/php/php.ini

RUN apt-get update \
  && apt-get install -y \
  git \
  zip \
  unzip \
  vim \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libicu-dev \
  libfontconfig1 \
  libxrender1 \
  && apt-get clean

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install intl
RUN docker-php-ext-install pdo_mysql mysqli

WORKDIR /usr/bin
RUN curl -s https://getcomposer.org/installer | php &&\
  ln -s /usr/bin/composer.phar /usr/bin/composer

# xdebug
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

# mailhog
RUN curl -sSLO https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 \
  && chmod +x mhsendmail_linux_amd64 \
  && mv mhsendmail_linux_amd64 /usr/local/bin/mhsendmail

WORKDIR /var/www
