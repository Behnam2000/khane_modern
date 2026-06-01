<?php include $this->resolve('admin/layout/header.php'); ?>

<h2>مدیریت کاربران</h2>

<?php if (!empty($success)): ?>
  <div class="success-message"><?php echo e($success); ?></div>
<?php endif; ?>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th>نام</th>
        <th>تلفن</th>
        <th>ایمیل</th>
        <th>نقش</th>
        <th>تاریخ ثبت</th>
        <th>عملیات</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo e(trim($user['first_name'] . ' ' . $user['last_name'])); ?></td>
          <td><?php echo e($user['phone']); ?></td>
          <td><?php echo e($user['email']); ?></td>
          <td><?php echo e($user['role']); ?></td>
          <td><?php echo e($user['created_at']); ?></td>
          <td>
            <?php if ($user['role'] !== 'admin'): ?>
              <form action="/admin/users/delete" method="POST" class="inline-form" onsubmit="return confirm('کاربر حذف شود؟');">
                <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
                <input type="hidden" name="user_id" value="<?php echo (int) $user['id']; ?>" />
                <button type="submit" class="button-link danger">حذف</button>
              </form>
            <?php else: ?>
              —
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include $this->resolve('admin/layout/footer.php'); ?>
