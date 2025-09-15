<?php include __DIR__ . '/header.php'; ?>
<h3 class="text-success mt-2">Admin Dashboard</h3>
<div class="d-flex gap-2">
  <a class="btn btn-outline-success" href="?action=guests">View Guests</a>
  <a class="btn btn-outline-success" href="?action=photos">Manage Photos</a>
  <a class="btn btn-outline-danger ms-auto" href="?action=logout">Logout</a>
</div>
<div class="row g-3 mt-2">
  <div class="col-sm-4"><div class="p-3 border rounded-3"><div>Total RSVPs</div><div class="fs-2 fw-bold"><?= (int)($stats['total'] ?? 0) ?></div></div></div>
  <div class="col-sm-4"><div class="p-3 border rounded-3"><div>Attending (Yes)</div><div class="fs-2 fw-bold text-success"><?= (int)($stats['yes'] ?? 0) ?></div></div></div>
  <div class="col-sm-4"><div class="p-3 border rounded-3"><div>Maybe</div><div class="fs-2 fw-bold text-warning"><?= (int)($stats['maybe'] ?? 0) ?></div></div></div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
