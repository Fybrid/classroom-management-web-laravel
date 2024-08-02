FROM php:8.3-fpm

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
  libzip-dev \
  libfontconfig1 \
  libxrender1 \
  && apt-get clean

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql mysqli

WORKDIR /usr/bin
RUN curl -s https://getcomposer.org/installer | php \
  && ln -s /usr/bin/composer.phar /usr/bin/composer

WORKDIR /var/www

RUN curl -sL https://deb.nodesource.com/setup_lts.x | bash - \
  && apt-get install -y nodejs \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN node -v && npm -v
RUN npm install -g create-react-app
RUN npm install -g create-next-app
RUN npm install -g node-sass