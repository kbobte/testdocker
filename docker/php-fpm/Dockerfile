FROM php:fpm
# FROM php:fpm-alpine

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

CMD ["php-fpm"]

EXPOSE 9000