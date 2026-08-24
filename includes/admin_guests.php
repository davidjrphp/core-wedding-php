<?php include __DIR__ . '/header.php'; ?>
<h3 class="text-success mt-2">Guest List</h3>
<a class="btn btn-outline-success mb-2" href="?action=admin">Back</a>

<?php if (!empty($_SESSION['flash'])): ?>
  <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead><tr>
      <th>Name</th><th>Email</th><th>Phone</th><th>Attending</th><th>Side</th><th>Message</th><th>When</th><th>RSVP Status</th><th>Action</th>
    </tr></thead>
    <tbody>
    <?php foreach ($guests as $g): ?>
      <?php
        $side = $g['family_side'] ?? null;
        $sideLabel = $side === 'groom' ? "Groom's" : ($side === 'bride' ? "Bride's" : '—');
        $status = $g['rsvp_status'] ?? 'pending';
        $statusClass = ['acknowledged' => 'text-bg-success', 'declined' => 'text-bg-danger', 'pending' => 'text-bg-secondary'][$status] ?? 'text-bg-secondary';
      ?>
      <tr>
        <td><?= htmlspecialchars($g['full_name']) ?></td>
        <td><?= htmlspecialchars($g['email'] ?? '') ?></td>
        <td><?= htmlspecialchars($g['phone'] ?? '') ?></td>
        <td class="text-uppercase"><?= htmlspecialchars($g['attending']) ?></td>
        <td><?= htmlspecialchars($sideLabel) ?></td>
        <td><?= htmlspecialchars($g['message'] ?? '') ?></td>
        <td><?= htmlspecialchars($g['created_at']) ?></td>
        <td><span class="badge <?= $statusClass ?> text-uppercase"><?= htmlspecialchars($status) ?></span></td>
        <td>
          <form method="post" action="?action=update_rsvp_status" class="d-flex gap-1">
            <input type="hidden" name="id" value="<?= (int)$g['id'] ?>">
            <button type="submit" name="rsvp_status" value="acknowledged" class="btn btn-sm btn-outline-success" <?= $status === 'acknowledged' ? 'disabled' : '' ?>>Acknowledge</button>
            <button type="submit" name="rsvp_status" value="declined" class="btn btn-sm btn-outline-danger" <?= $status === 'declined' ? 'disabled' : '' ?>>Decline</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/footer.php'; ?>
