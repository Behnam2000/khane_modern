<?php include $this->resolve("layouts/header.php"); ?>

<main class="site-main container">
  <section class="hero section-panel">
    <h2>نظرات مشتریان</h2>
    <p>بازخوردهایی که نشان می‌دهد مشتریان چگونه فضای جدید خود را تجربه کرده‌اند.</p>
  </section>

  <?php if (!empty($success)): ?>
    <div class="success-message"><?php echo e($success); ?></div>
  <?php endif; ?>

  <section class="grid-3">
    <?php if (empty($reviews)): ?>
      <p>هنوز نظری تأیید نشده است. اولین نفری باشید که نظر می‌دهد.</p>
    <?php else: ?>
      <?php foreach ($reviews as $review): ?>
        <article class="testimonial-card">
          <h3><?php echo e(trim(($review['first_name'] ?? '') . ' ' . ($review['last_name'] ?? ''))); ?></h3>
          <p><?php echo e($review['body']); ?></p>
          <?php if (!empty($review['rating'])): ?>
            <p><?php echo starRating((int) $review['rating']); ?></p>
          <?php endif; ?>
          <?php if (!empty($review['admin_response'])): ?>
            <blockquote class="admin-reply">
              <strong>پاسخ مدیر:</strong>
              <?php echo e($review['admin_response']); ?>
            </blockquote>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>

  <section class="section-panel review-form-panel">
    <h3>ثبت نظر شما</h3>
    <?php if (!empty($currentUser)): ?>
      <form action="/nazarat" method="POST" class="site-form">
        <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />

        <div class="form-group <?php echo array_key_exists('body', $errors ?? []) ? 'has-error' : ''; ?>">
          <label for="body">متن نظر</label>
          <textarea id="body" name="body" rows="4" required><?php echo e($_POST['body'] ?? ''); ?></textarea>
          <?php if (array_key_exists('body', $errors ?? [])): ?>
            <div class="field-error"><?php echo e($errors['body'][0]); ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group <?php echo array_key_exists('rating', $errors ?? []) ? 'has-error' : ''; ?>">
          <label for="rating">امتیاز</label>
          <select id="rating" name="rating" required>
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <option value="<?php echo $i; ?>" <?php echo (($_POST['rating'] ?? '') == $i) ? 'selected' : ''; ?>>
                <?php echo starRating($i); ?>
              </option>
            <?php endfor; ?>
          </select>
          <?php if (array_key_exists('rating', $errors ?? [])): ?>
            <div class="field-error"><?php echo e($errors['rating'][0]); ?></div>
          <?php endif; ?>
        </div>

        <button type="submit" class="button-link">ارسال نظر</button>
      </form>
    <?php else: ?>
      <p>برای ثبت نظر ابتدا <a href="/login">وارد حساب</a> خود شوید یا <a href="/register">ثبت‌نام</a> کنید.</p>
    <?php endif; ?>
  </section>
</main>

<?php include $this->resolve("layouts/footer.php"); ?>
