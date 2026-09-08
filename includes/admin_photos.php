<?php include __DIR__ . '/header.php'; ?>
<h3 class="text-success mt-2">Manage Photos</h3>
<a class="btn btn-outline-success mb-2" href="?action=admin">Back</a>

<?php if (!empty($_SESSION['flash'])): ?>
  <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<div class="p-3 border rounded-3 mb-3">
  <form method="post" action="?action=upload_photo" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Photo</label>
      <input type="file" name="photo" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Caption</label>
      <input type="text" name="caption" class="form-control">
    </div>
    <div class="col-12"><button class="btn btn-success">Upload</button></div>
  </form>
</div>

<div class="row g-3">
  <?php foreach ($photos as $p): ?>
    <div class="col-sm-3">
      <div class="border rounded-3 p-2">
        <img src="uploads/photos/<?=
             htmlspecialchars($p['path']) ?>" class="w-100" style="height:160px;object-fit:cover;border-radius:.5rem">
        <div class="mt-2 small"><?= htmlspecialchars($p['caption'] ?? '') ?></div>
        <form method="post" action="?action=delete_photo" onsubmit="return confirm('Delete this photo?')">
          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
          <button class="btn btn-sm btn-outline-danger mt-2">Delete</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
