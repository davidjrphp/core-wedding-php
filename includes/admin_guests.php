<?php include __DIR__ . '/header.php'; ?>
<h3 class="text-success mt-2">Guest List</h3>
<a class="btn btn-outline-success mb-2" href="?action=admin">Back</a>
<div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead><tr>
      <th>Name</th><th>Email</th><th>Phone</th><th>Attending</th><th>Message</th><th>When</th>
    </tr></thead>
    <tbody>
    <?php foreach ($guests as $g): ?>
      <tr>
        <td><?= htmlspecialchars($g['full_name']) ?></td>
        <td><?= htmlspecialchars($g['email'] ?? '') ?></td>
        <td><?= htmlspecialchars($g['phone'] ?? '') ?></td>
        <td class="text-uppercase"><?= htmlspecialchars($g['attending']) ?></td>
        <td><?= htmlspecialchars($g['message'] ?? '') ?></td>
        <td><?= htmlspecialchars($g['created_at']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/footer.php'; ?>
