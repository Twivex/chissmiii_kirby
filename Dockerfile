### Base Stage
## Bootstrap from PHP container
FROM php:8.0-apache as base-stage
# set default env
ARG ENV=production

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

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions \
      curl \
      dom \
      gd \
      intl \
      mbstring \
      xml \
      zip

RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# pecl config
RUN pecl channel-update pecl.php.net
RUN pecl config-set php_ini /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini
RUN pear config-set php_ini /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini

RUN pecl install zlib zip


# Install Node JS
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Copy environment dependent php.ini file
RUN cp $PHP_INI_DIR/php.ini-$ENV $PHP_INI_DIR/php.ini
COPY files/custom-php.ini $PHP_INI_DIR/conf.d/custom-php.ini

## Copy environment dependent apache config file
COPY files/apache.conf /etc/apache2/sites-available/000-default.conf

## Enable modrewrite and SSL module
RUN a2enmod headers
RUN a2enmod rewrite

WORKDIR /var/www/html/
CMD ["apache2-foreground"]

### Production Stage
FROM base-stage as prod-stage

# copy files
COPY ./dist ./
