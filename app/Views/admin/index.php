<?php include $this->resolve('admin/layout/header.php'); ?>

<section class="admin-dashboard">
  <h2>داشبورد</h2>
  <div class="admin-stats grid-3">
    <article class="admin-stat-card">
      <h3>کاربران</h3>
      <p><?php echo (int) ($stats['users'] ?? 0); ?></p>
    </article>
    <article class="admin-stat-card">
      <h3>نظرات</h3>
      <p><?php echo (int) ($stats['reviews'] ?? 0); ?></p>
    </article>
    <article class="admin-stat-card">
      <h3>در انتظار تأیید</h3>
      <p><?php echo (int) ($stats['pendingReviews'] ?? 0); ?></p>
    </article>
    <article class="admin-stat-card">
      <h3>نمونه‌کارها</h3>
      <p><?php echo (int) ($stats['pics'] ?? 0); ?></p>
    </article>
  </div>
</section>

<?php include $this->resolve('admin/layout/footer.php'); ?>
