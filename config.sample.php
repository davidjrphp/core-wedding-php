<?php
// Copy to config.php and edit for local development.
// In production, config.php is generated automatically from environment
// variables by docker/app/entrypoint.sh — do not commit real credentials.
return [
  'db' => [
    'host' => 'host.docker.internal',
    'port' => 5432,
    'name' => 'wedding',
    'user' => 'postgres',
    'pass' => 'changeme',
  ],
  'admin' => [
    'email' => 'admin@example.com',
    'password' => 'changeme'
  ],
  'app' => [
    'base_url' => 'http://localhost:8083'
  ],
  'mail' => [
    // Gmail SMTP. smtp_user must be a full Gmail address; smtp_pass is a
    // 16-character App Password (Google Account > Security > App passwords),
    // not the account's real login password.
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_user' => '',
    'smtp_pass' => '',
    'from_name' => 'Wedding RSVP (No Reply)'
  ]
];
