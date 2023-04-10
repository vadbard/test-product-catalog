FROM php:8.1-fpm-alpine3.16 as php

RUN apk add --no-cache --update \
        git \
        jpegoptim optipng pngquant gifsicle imagemagick \
        icu-dev \
        libtool \
        libxml2-dev \
        postgresql-libs postgresql-dev \
        libzip-dev zlib-dev libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev

RUN docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg --with-freetype \
    && docker-php-ext-install gd

RUN docker-php-ext-install zip intl exif pcntl bcmath sockets opcache

RUN apk add --no-cache --update libxml2-dev \
        && docker-php-ext-install xml

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

#######################
FROM php AS dev
RUN apk add --no-cache --update shadow bash openssh
WORKDIR /var/www/app
RUN usermod -u ${TARGET_UID:-1000} www-data && groupmod -g ${TARGET_GID:-1000} www-data
RUN chown www-data:www-data /var/www/app

#######################
RUN apk add --no-cache nodejs npm

#ENV PYTHONUNBUFFERED=1
#RUN apk add --no-cache --update python3 && ln -sf python3 /usr/bin/python
#RUN python -m ensurepip
#RUN pip3 install --no-cache --upgrade pip setuptools

#COPY --chown=www-data:www-data ./src/composer.json ./composer.json
#COPY --chown=www-data:www-data ./src/composer.lock ./composer.lock

USER www-data:www-data

FROM dev AS test

COPY --chown=www-data:www-data ./src/ ./

#######################
FROM dev AS dev-debug
USER root:root
RUN apk add --no-cache --virtual .build-deps ${PHPIZE_DEPS} \
    && apk add --update linux-headers \
    && pecl install xdebug-3.2.0 \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

USER www-data:www-data

#######################
FROM php AS php-prod

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

WORKDIR /var/www/app
COPY --chown=www-data:www-data ./src /var/www/app
RUN chown www-data:www-data /var/www/app \
    && chown www-data:www-data -R /var/lib/nginx/logs/

EXPOSE 5000
EXPOSE 9000
# ENTRYPOINT ["sh", "/entrypoint.sh"]


FROM php-prod AS prod

WORKDIR /var/www/app
#COPY --chown=www-data:www-data ./src/composer.json ./composer.json
#COPY --chown=www-data:www-data ./src/composer.lock ./composer.lock
#COPY --chown=www-data:www-data ./src/package.json  ./package.json
#COPY --chown=www-data:www-data ./src/package-lock.json ./package-lock.json

# RUN composer install -o --no-dev
# RUN npm install
# RUN npx mix
