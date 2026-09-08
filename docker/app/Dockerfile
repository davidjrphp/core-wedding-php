FROM php:8.2-fpm-alpine

# Install pgsql and helpful tools
RUN apk add --no-cache libpq-dev tzdata \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

# PHP-FPM slowlog (helps debug timeouts)
RUN { \
  echo "[www]"; \
  echo "request_slowlog_timeout=5s"; \
  echo "slowlog=/tmp/php-fpm.slow.log"; \
} > /usr/local/etc/php-fpm.d/zz-slowlog.conf

# Set timezone (Lusaka)
ENV TZ=Africa/Lusaka

# App code. In local dev, docker-compose.yml bind-mounts these paths over the
# top for live editing; in production the image is self-contained.
COPY public/ /var/www/html/public/
COPY includes/ /var/www/html/includes/
COPY schema.sql /var/www/html/schema.sql
COPY config.sample.php /var/www/html/config.sample.php

RUN mkdir -p /var/www/html/public/uploads/photos \
 && chown -R www-data:www-data /var/www/html/public/uploads

COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
