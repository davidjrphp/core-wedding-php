FROM nginx:1.25-alpine

RUN apk add --no-cache openssl

COPY docker/nginx/default.conf.template /etc/nginx/templates/default.conf.template
COPY docker/nginx/docker-entrypoint.d/10-dummy-cert.sh /docker-entrypoint.d/10-dummy-cert.sh
RUN chmod +x /docker-entrypoint.d/10-dummy-cert.sh

COPY public/ /var/www/html/public/
