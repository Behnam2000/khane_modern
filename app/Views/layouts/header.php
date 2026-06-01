<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?? 'خانه ی مدرن'; ?> </title>
    <link rel="stylesheet" href="/assets/styles.css" />
</head>

<body class="<?php echo $bodyClass ?? 'site-wrapper'; ?>">

    <?php /* Only show the header if we are NOT on an auth page */ ?>
    <?php if (($bodyClass ?? '') !== 'auth-body'): ?>
        <header class="site-header">
            <div class="inner container">

                <a href="/" style="text-decoration: none;">
                    <h1 class="site-title">خانه ی مدرن</h1>
                </a>

                <nav class="site-nav">
                    <a href="/kadamat">خدمات</a>
                    <a href="/nemoneh">نمونه کارها</a>
                    <a href="/about">درباره ما</a>
                    <a href="/maghalat">مقالات و مجله ها</a>
                    <a href="/nazarat">نظرات و پیشنهاد ها</a>
                </nav>

                <div class="auth-actions">
                    <?php if (!empty($currentUser)): ?>
                        <span class="nav-user">سلام، <?php echo e($currentUser['first_name']); ?></span>
                        <?php if (($currentUser['role'] ?? '') === 'admin'): ?>
                            <a href="/admin" class="nav-login">پنل مدیریت</a>
                        <?php endif; ?>
                        <form action="/logout" method="POST" class="inline-form">
                            <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
                            <button type="submit" class="nav-login">خروج</button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="nav-login">ورود</a>
                        <a href="/register" class="button-link nav-register">ثبت نام</a>
                    <?php endif; ?>
                </div>

            </div>
        </header>
    <?php endif; ?>