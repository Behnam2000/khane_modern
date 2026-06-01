<?php $title = 'ورود به حساب - خانه ی مدرن'; ?>
<?php include $this->resolve("layouts/header.php"); ?>

<?php $oldFormData = $oldFormData ?? []; ?>

<main class="site-main container">
    <section class="section-panel auth-panel">
        <div class="form-header">
            <h1>خوش آمدید</h1>
            <p>وارد حساب کاربری خود شوید</p>
        </div>

        <?php if (!empty($errors['password'][0])): ?>
            <div class="error-message">
                <?php echo e($errors['password'][0]); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-message">
                <?php echo e($success); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="site-form">
            <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />

            <div class="form-group <?php echo array_key_exists('phone', $errors ?? []) ? 'has-error' : ''; ?>">
                <label for="phone">شماره تلفن</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="09123456789"
                    required
                    value="<?php echo e($oldFormData['phone'] ?? ''); ?>">
                <?php if (array_key_exists('phone', $errors ?? [])): ?>
                    <div class="field-error"><?php echo e($errors['phone'][0]); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">رمز عبور</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="رمز عبور خود را وارد کنید"
                    required>
            </div>

            <div class="form-group remember-me">
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">مرا به خاطر بسبار</label>
                </div>
                <a href="/forgot-password" class="forgot-password">آیا رمز عبور را فراموش کرده‌اید؟</a>
            </div>

            <button type="submit" class="btn-login button-link">ورود</button>

            <div class="divider">
                <span>یا</span>
            </div>

            <div class="form-footer">
                حساب کاربری ندارید؟ <a href="/register">ثبت نام کنید</a>
            </div>
        </form>
    </section>
</main>

<?php include $this->resolve("layouts/footer.php"); ?>