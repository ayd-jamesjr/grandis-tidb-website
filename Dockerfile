FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends ca-certificates \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html/
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENV PORT=10000

EXPOSE 10000

ENTRYPOINT ["docker-entrypoint.sh"]
