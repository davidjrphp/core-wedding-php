<?php include __DIR__ . '/header.php'; ?>
<div class="row justify-content-center mt-5">
  <div class="col-md-5">
    <div class="p-4 shadow-sm rounded-4">
      <h3 class="text-success">Admin Login</h3>
      <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
      <?php endif; ?>
      <form method="post" action="?action=do_login">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">Login</button>
      </form>
    </div>
  </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
