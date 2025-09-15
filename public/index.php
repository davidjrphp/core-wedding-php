<?php
if (session_status() === PHP_SESSION_NONE) session_start();
date_default_timezone_set('Africa/Lusaka');

$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
  $configPath = __DIR__ . '/../config.php';
}
$config = require $configPath;

function db() {
  static $pdo = null;
  global $config;
  if ($pdo === null) {
    $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s',
      $config['db']['host'], $config['db']['port'], $config['db']['name']);
    $pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass'], [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
  }
  return $pdo;
}
function is_admin(){ return !empty($_SESSION['admin']); }
function require_admin(){ if(!is_admin()){ header('Location: ?action=login'); exit; } }

$action = $_GET['action'] ?? 'home';

/* RSVP */
if ($action === 'rsvp' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $full = trim($_POST['full_name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $att = in_array($_POST['attending'] ?? 'maybe', ['yes','no','maybe']) ? $_POST['attending'] : 'maybe';
  $msg = trim($_POST['message'] ?? '');
  if ($full === '') { http_response_code(422); die('Full name required'); }
  $stmt = db()->prepare('INSERT INTO guests (full_name,email,phone,attending,message) VALUES (?,?,?,?,?)');
  $stmt->execute([$full,$email ?: null,$phone ?: null,$att,$msg ?: null]);
  $_SESSION['flash'] = 'Thank you! Your RSVP has been recorded.';
  header('Location: ./'); exit;
}

/* Auth */
if ($action === 'login') { include __DIR__ . '/../includes/admin_login.php'; exit; }
if ($action === 'do_login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? ''); $pass = $_POST['password'] ?? '';
  if ($email === ($config['admin']['email'] ?? '') && $pass === ($config['admin']['password'] ?? '')) {
    $_SESSION['admin'] = $email; header('Location: ?action=admin'); exit;
  }
  $_SESSION['error']='Invalid credentials'; header('Location: ?action=login'); exit;
}
if ($action === 'logout') { session_destroy(); header('Location: ./'); exit; }

/* Admin pages */
if ($action === 'admin') {
  require_admin();
  $total = db()->query("SELECT COUNT(*) FROM guests")->fetchColumn();
  $yes   = db()->query("SELECT COUNT(*) FROM guests WHERE attending='yes'")->fetchColumn();
  $maybe = db()->query("SELECT COUNT(*) FROM guests WHERE attending='maybe'")->fetchColumn();
  $stats = ['total'=>$total,'yes'=>$yes,'maybe'=>$maybe];
  include __DIR__ . '/../includes/admin_dashboard.php'; exit;
}
if ($action === 'guests') {
  require_admin();
  $guests = db()->query("SELECT * FROM guests ORDER BY created_at DESC LIMIT 1000")->fetchAll();
  include __DIR__ . '/../includes/admin_guests.php'; exit;
}
if ($action === 'photos') {
  require_admin();
  $photos = db()->query("SELECT * FROM photos ORDER BY uploaded_at DESC LIMIT 200")->fetchAll();
  include __DIR__ . '/../includes/admin_photos.php'; exit;
}
if ($action === 'upload_photo' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_admin();
  if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) { die('Upload failed'); }
  $f = $_FILES['photo'];
  $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
  $ok = ['jpg','jpeg','png','gif','webp'];
  if (!in_array($ext, $ok)) { die('Only images allowed'); }
  if ($f['size'] > 20*1024*1024) { die('Max 20MB'); }
  $name = bin2hex(random_bytes(8)) . '.' . $ext;
  $destDir = __DIR__ . '/uploads/photos';
  if (!is_dir($destDir)) { mkdir($destDir, 0777, true); }
  $dest = $destDir . '/' . $name;
  if (!move_uploaded_file($f['tmp_name'], $dest)) { die('Could not save file'); }
  $caption = trim($_POST['caption'] ?? '');
  $stmt = db()->prepare('INSERT INTO photos (path, caption) VALUES (?, ?)');
  $stmt->execute([$name, $caption ?: null]);
  $_SESSION['flash'] = 'Photo uploaded.';
  header('Location: ?action=photos'); exit;
}
if ($action === 'delete_photo' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_admin();
  $id = (int)($_POST['id'] ?? 0);
  $stmt = db()->prepare('SELECT path FROM photos WHERE id=?'); $stmt->execute([$id]);
  if ($row = $stmt->fetch()) {
    @unlink(__DIR__ . '/uploads/photos/' . $row['path']);
    db()->prepare('DELETE FROM photos WHERE id=?')->execute([$id]);
  }
  $_SESSION['flash'] = 'Photo deleted.';
  header('Location: ?action=photos'); exit;
}

/* Landing */
if ($action === 'home') {
  $photos = db()->query("SELECT path, caption FROM photos ORDER BY uploaded_at DESC LIMIT 12")->fetchAll();
  include __DIR__ . '/../includes/landing.php'; exit;
}

http_response_code(404);
echo 'Not found';
