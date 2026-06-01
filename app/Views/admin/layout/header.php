<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo e($title ?? 'پنل مدیریت'); ?></title>
  <link rel="stylesheet" href="/assets/styles.css" />
</head>
<body class="site-wrapper admin-body">
  <header class="admin-header">
    <div class="container admin-header-inner">
      <a href="/admin" class="admin-brand">پنل مدیریت — خانه مدرن</a>
      <nav class="admin-nav">
        <a href="/admin">داشبورد</a>
        <a href="/admin/reviews">نظرات</a>
        <a href="/admin/users">کاربران</a>
        <a href="/admin/pics">نمونه‌کارها</a>
        <a href="/">بازگشت به سایت</a>
      </nav>
      <form action="/logout" method="POST" class="admin-logout-form">
        <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
        <button type="submit" class="button-link">خروج</button>
      </form>
    </div>
  </header>
  <main class="site-main container admin-main">
