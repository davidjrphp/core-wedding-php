<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$config = require __DIR__ . '/../config.php';
$base = rtrim($config['app']['base_url'] ?? '', '/');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mulumba &amp; Patrick</title>
  <meta name="theme-color" content="#2F5D50">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
  <div class="container">
    <a class="navbar-brand text-success fw-bold" href="<?= $base ?>/">
      <span class="brand-script fs-3">Mulumba</span> &amp; <span class="brand-script fs-3">Patrick</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#ourday">Our Day</a></li>
        <li class="nav-item"><a class="nav-link" href="#story">Our Story</a></li>
        <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#rsvp">RSVP</a></li>
        <li class="nav-item"><a class="btn btn-outline-success ms-2" href="<?= $base ?>/?action=login">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-3">
