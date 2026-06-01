<?php include $this->resolve('admin/layout/header.php'); ?>

<h2>مدیریت نظرات</h2>

<?php if (!empty($success)): ?>
  <div class="success-message"><?php echo e($success); ?></div>
<?php endif; ?>

<?php if (empty($reviews)): ?>
  <p class="admin-empty">هنوز نظری ثبت نشده است.</p>
<?php else: ?>
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>کاربر</th>
          <th>متن</th>
          <th>امتیاز</th>
          <th>وضعیت</th>
          <th>پاسخ مدیر</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reviews as $review): ?>
          <tr>
            <td><?php echo e(trim(($review['first_name'] ?? '') . ' ' . ($review['last_name'] ?? ''))); ?></td>
            <td><?php echo e($review['body']); ?></td>
            <td><?php echo starRating((int) ($review['rating'] ?? 0)); ?></td>
            <td><?php echo e($review['status']); ?></td>
            <td><?php echo e($review['admin_response'] ?? '—'); ?></td>
            <td class="admin-actions">
              <?php if ($review['status'] === 'pending'): ?>
                <form action="/admin/reviews" method="POST" class="inline-form">
                  <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
                  <input type="hidden" name="review_id" value="<?php echo (int) $review['id']; ?>" />
                  <input type="hidden" name="action" value="approve" />
                  <button type="submit" class="button-link">تأیید</button>
                </form>
                <form action="/admin/reviews" method="POST" class="inline-form">
                  <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
                  <input type="hidden" name="review_id" value="<?php echo (int) $review['id']; ?>" />
                  <input type="hidden" name="action" value="reject" />
                  <button type="submit" class="button-link secondary">رد</button>
                </form>
              <?php endif; ?>
              <form action="/admin/reviews" method="POST" class="admin-respond-form">
                <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
                <input type="hidden" name="review_id" value="<?php echo (int) $review['id']; ?>" />
                <input type="hidden" name="action" value="respond" />
                <textarea name="response" rows="2" placeholder="پاسخ مدیر"><?php echo e($review['admin_response'] ?? ''); ?></textarea>
                <button type="submit" class="button-link">ثبت پاسخ</button>
              </form>
              <form action="/admin/reviews" method="POST" class="inline-form" onsubmit="return confirm('حذف شود؟');">
                <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
                <input type="hidden" name="review_id" value="<?php echo (int) $review['id']; ?>" />
                <input type="hidden" name="action" value="delete" />
                <button type="submit" class="button-link danger">حذف</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php include $this->resolve('admin/layout/footer.php'); ?>
