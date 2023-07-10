## Bootstrap from PHP container
FROM php:8.0-apache
# set time zone variable
ENV TZ=Europe/Berlin

# set localtime
RUN rm /etc/localtime; ln -s /usr/share/zoneinfo/$TZ /etc/localtime; dpkg-reconfigure -f noninteractive tzdata

# Installing dependencies
RUN apt-get update \
    && apt-get upgrade -y
RUN apt-get install -y --no-install-recommends \
      curl \
      git \
      make \
      less \
      nano \
      libmcrypt-dev \
      zip \
      libzip-dev

RUN apt-get install --assume-yes --no-install-recommends --quiet \
    build-essential \
    libmagickwand-dev \
    ffmpeg

 RUN apt-get clean all

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions \
      gd \
      intl \
      zip

RUN pecl install imagick \
 && docker-php-ext-enable imagick

# pecl config
RUN pecl channel-update pecl.php.net
RUN pecl config-set php_ini /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini
RUN pear config-set php_ini /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini

RUN pecl install zlib zip

# Install Node JS
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

COPY files/custom-php.ini $PHP_INI_DIR/conf.d/custom-php.ini

## Copy environment dependent apache config file
COPY files/apache.conf /etc/apache2/sites-available/000-default.conf

## Enable modrewrite and SSL module
RUN a2enmod headers
RUN a2enmod rewrite

WORKDIR /var/www/html/
CMD ["apache2-foreground"]
