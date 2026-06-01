<?php include $this->resolve("layouts/header.php"); ?>

<main class="site-main container">
  <section class="hero section-panel">
    <h2>پروژه‌های ما در عمل</h2>
    <p>نمونه‌هایی از اجراهایی که با خلاقیت و دقت بالا برای مشتریان طراحی کرده‌ایم.</p>
  </section>
  <section class="grid-3">
    <?php if (empty($pics)): ?>
      <p>در حال حاضر نمونه‌کاری برای نمایش وجود ندارد.</p>
    <?php else: ?>
      <?php foreach ($pics as $pic): ?>
        <article class="card">
          <img src="<?php echo picUrl($pic['filename']); ?>" alt="<?php echo e($pic['title']); ?>" />
          <h3><?php echo e($pic['title']); ?></h3>
          <?php if (!empty($pic['description'])): ?>
            <p><?php echo e($pic['description']); ?></p>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</main>

<?php include $this->resolve("layouts/footer.php"); ?>
