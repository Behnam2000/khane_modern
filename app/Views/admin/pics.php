<?php include $this->resolve('admin/layout/header.php'); ?>

<h2>مدیریت نمونه‌کارها</h2>

<?php if (!empty($success)): ?>
  <div class="success-message"><?php echo e($success); ?></div>
<?php endif; ?>

<?php if (!empty($errors['image'][0])): ?>
  <div class="error-message"><?php echo e($errors['image'][0]); ?></div>
<?php endif; ?>

<section class="admin-panel section-panel">
  <h3>افزودن تصویر جدید</h3>
  <form action="/admin/pics/upload" method="POST" enctype="multipart/form-data" class="site-form admin-form">
    <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
    <div class="form-group">
      <label for="title">عنوان</label>
      <input type="text" id="title" name="title" required />
    </div>
    <div class="form-group">
      <label for="description">توضیحات</label>
      <textarea id="description" name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="sort_order">ترتیب نمایش</label>
      <input type="number" id="sort_order" name="sort_order" value="0" min="0" />
    </div>
    <div class="form-group">
      <label for="image">فایل تصویر</label>
      <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" required />
    </div>
    <button type="submit" class="button-link">آپلود</button>
  </form>
</section>

<section class="admin-pics-grid grid-3">
  <?php foreach ($pics as $pic): ?>
    <article class="card admin-pic-card">
      <img src="<?php echo picUrl($pic['filename']); ?>" alt="<?php echo e($pic['title']); ?>" />
      <form action="/admin/pics/update" method="POST" class="site-form admin-form">
        <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
        <input type="hidden" name="pic_id" value="<?php echo (int) $pic['id']; ?>" />
        <div class="form-group">
          <label>عنوان</label>
          <input type="text" name="title" value="<?php echo e($pic['title']); ?>" required />
        </div>
        <div class="form-group">
          <label>توضیحات</label>
          <textarea name="description" rows="2"><?php echo e($pic['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
          <label>ترتیب</label>
          <input type="number" name="sort_order" value="<?php echo (int) $pic['sort_order']; ?>" min="0" />
        </div>
        <div class="form-group checkbox">
          <input type="checkbox" name="is_active" id="active-<?php echo (int) $pic['id']; ?>" <?php echo !empty($pic['is_active']) ? 'checked' : ''; ?> />
          <label for="active-<?php echo (int) $pic['id']; ?>">فعال</label>
        </div>
        <button type="submit" class="button-link">ذخیره</button>
      </form>
      <form action="/admin/pics/delete" method="POST" onsubmit="return confirm('تصویر حذف شود؟');">
        <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
        <input type="hidden" name="pic_id" value="<?php echo (int) $pic['id']; ?>" />
        <button type="submit" class="button-link danger">حذف</button>
      </form>
    </article>
  <?php endforeach; ?>
</section>

<?php include $this->resolve('admin/layout/footer.php'); ?>
