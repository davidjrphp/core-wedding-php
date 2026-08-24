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
  ]
];
PHP
fi

exec "$@"
