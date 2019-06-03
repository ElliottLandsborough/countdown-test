# composer
FROM composer:latest as vendor

COPY composer.json composer.lock ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# build css & js
FROM node:current-alpine as frontend

RUN mkdir -p ./public/build

COPY package.json webpack.config.js symfony.lock yarn.lock .env ./
COPY assets/ assets/

RUN yarn install && yarn encore production

# php
FROM php:7-fpm-alpine

COPY . /var/www/html
RUN  rm -rf /var/cache/apk/*
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
COPY --from=frontend /public/build/ /var/www/html/public/build/

# change uid and gid for www-data user (alpine)
RUN apk --no-cache add shadow && \
    usermod -u 1000 www-data && \
    groupmod -g 1000 www-data
