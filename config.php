<?php
// Copy to config.php and edit.
return [
  'db' => [
    // Windows Postgres from inside Docker:
    'host' => 'host.docker.internal',
    'port' => 5432,
    'name' => 'wedding',
    'user' => 'postgres',
    'pass' => '1234',
  ],
  'admin' => [
    'email' => 'david@wedding.com',
    'password' => 'davidihm@123' 
  ],
  'app' => [
    'base_url' => 'http://localhost:8080'
  ]
];
