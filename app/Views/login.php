<?php $title = 'ورود به حساب - خانه ی مدرن'; ?>
<?php include $this->resolve("layouts/header.php"); ?>

<main class="site-main container">
    <section class="section-panel auth-panel">
        <div class="form-header">
            <h1>خوش آمدید</h1>
            <p>وارد حساب کاربری خود شوید</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="site-form">
            <div class="form-group">
                <label for="email">آدرس ایمیل</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="ایمیل خود را وارد کنید"
                    required
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
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