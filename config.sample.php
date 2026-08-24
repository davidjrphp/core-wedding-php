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
  ]
];
