#!/bin/sh
# Runs automatically before nginx starts (nginx's official entrypoint executes
# every *.sh in /docker-entrypoint.d/). Let's Encrypt's real certificate only
# exists after certbot completes its HTTP-01 challenge against nginx, so we
# need *some* cert in place first or nginx refuses to start the 443 server
# block at all. A one-day self-signed cert bridges that gap; the deploy
# script's certbot run overwrites it and reloads nginx right after.
set -e

: "${DOMAIN:?DOMAIN env var is required}"
CERT_DIR="/etc/letsencrypt/live/${DOMAIN}"

if [ ! -f "${CERT_DIR}/fullchain.pem" ]; then
  echo "No certificate for ${DOMAIN} yet — generating a temporary self-signed one so nginx can start"
  mkdir -p "${CERT_DIR}"
  openssl req -x509 -nodes -newkey rsa:2048 -days 1 \
    -keyout "${CERT_DIR}/privkey.pem" \
    -out "${CERT_DIR}/fullchain.pem" \
    -subj "/CN=${DOMAIN}"
fi
