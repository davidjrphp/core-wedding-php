#!/bin/sh
set -e

# In production, config.php is never baked into the image or committed to git.
# It's generated here from environment variables on every container start.
# php_escape single-quotes/backslashes so values can't break out of the
# single-quoted PHP string literal (e.g. a password containing a quote).
php_escape() {
  printf '%s' "$1" | sed "s/\\\\/\\\\\\\\/g; s/'/\\\\'/g"
}

if [ -n "$DB_HOST" ]; then
  DB_HOST_ESC=$(php_escape "$DB_HOST")
  DB_NAME_ESC=$(php_escape "$DB_NAME")
  DB_USER_ESC=$(php_escape "$DB_USER")
  DB_PASS_ESC=$(php_escape "$DB_PASS")
  ADMIN_EMAIL_ESC=$(php_escape "$ADMIN_EMAIL")
  ADMIN_PASSWORD_ESC=$(php_escape "$ADMIN_PASSWORD")
  BASE_URL_ESC=$(php_escape "${BASE_URL:-http://localhost}")
  SMTP_HOST_ESC=$(php_escape "${SMTP_HOST:-smtp.gmail.com}")
  SMTP_USER_ESC=$(php_escape "$SMTP_USER")
  SMTP_PASS_ESC=$(php_escape "$SMTP_PASS")
  MAIL_FROM_NAME_ESC=$(php_escape "${MAIL_FROM_NAME:-Wedding RSVP (No Reply)}")

  cat > /var/www/html/config.php <<PHP
<?php
return [
  'db' => [
    'host' => '${DB_HOST_ESC}',
    'port' => ${DB_PORT:-5432},
    'name' => '${DB_NAME_ESC}',
    'user' => '${DB_USER_ESC}',
    'pass' => '${DB_PASS_ESC}',
  ],
  'admin' => [
    'email' => '${ADMIN_EMAIL_ESC}',
    'password' => '${ADMIN_PASSWORD_ESC}'
  ],
  'app' => [
    'base_url' => '${BASE_URL_ESC}'
  ],
  'mail' => [
    'smtp_host' => '${SMTP_HOST_ESC}',
    'smtp_port' => ${SMTP_PORT:-587},
    'smtp_user' => '${SMTP_USER_ESC}',
    'smtp_pass' => '${SMTP_PASS_ESC}',
    'from_name' => '${MAIL_FROM_NAME_ESC}'
  ]
];
PHP
fi

exec "$@"
