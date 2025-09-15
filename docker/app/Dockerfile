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
