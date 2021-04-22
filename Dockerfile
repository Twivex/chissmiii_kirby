### Base Stage
## Bootstrap from PHP container
FROM php:7.4-apache as base-stage
# set default env
ARG env=production

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

###---
# do we need this?
# # Install composer
# RUN curl -sS https://getcomposer.org/installer | \
#     php -- --install-dir=/usr/local/bin --filename=composer

# # Add composer to path
# ENV PATH="/root/.composer/vendor/bin:${PATH}"
###---

# Set locales
# RUN echo "de_DE.UTF-8 UTF-8" >> /etc/locale.gen
# RUN locale-gen

## Add GIT LFS
# RUN curl -s https://packagecloud.io/install/repositories/github/git-lfs/script.deb.sh | bash
# RUN apt-get install git-lfs


# pecl config
RUN pecl channel-update pecl.php.net
RUN pecl config-set php_ini /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini
RUN pear config-set php_ini /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini

RUN pecl install zlib zip
# Add mcrypt via PECL

# RUN rm -rf /var/lib/apt/lists/*

# Copy environment dependent php.ini file
RUN cp $PHP_INI_DIR/php.ini-$env $PHP_INI_DIR/php.ini
# COPY ./files/php-bildmeister.ini $PHP_INI_DIR/conf.d

## Copy apache config file to container
COPY files/apache.conf /etc/apache2/sites-enabled/000-default.conf

## Enable modrewrite and SSL module
RUN a2enmod rewrite
RUN a2enmod ssl

WORKDIR /var/www/html/

### Production Stage
FROM base-stage as prod-stage
RUN pecl install mcrypt-1.0.3
RUN docker-php-ext-enable mcrypt

COPY ./dist ./

RUN chown -R :www-data /var/www/html
RUN chmod -R 775 /var/www/html
