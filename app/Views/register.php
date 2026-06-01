<?php $title = 'ثبت نام - خانه ی مدرن'; ?>
<?php include $this->resolve("layouts/header.php"); ?>

<?php
$errors = $errors ?? [];
$oldFormData = $oldFormData ?? [];
?>

<main class="site-main container">
    <section class="section-panel auth-panel">
        <div class="form-header">
            <h1>ثبت نام</h1>
            <p>برای درخواست و مشاوره ثبت نام کنید</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo e($error); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-message">
                <?php echo e($success); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" id="registerForm" class="site-form">
            <input type="hidden" name="token" value="<?php echo e($csrfToken ?? ''); ?>" />
            <div class="form-row">
                <div class="form-group <?php echo array_key_exists('first_name', $errors) ? 'has-error' : ''; ?>">
                    <label for="first_name">نام <span class="required">*</span></label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="نام خود را وارد کنید"
                        value="<?php echo e($oldFormData['first_name'] ?? ''); ?>">
                    <?php if (array_key_exists('first_name', $errors)) : ?>
                        <div class="field-error"><?php echo e($errors['first_name'][0]); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo array_key_exists('last_name', $errors) ? 'has-error' : ''; ?>">
                    <label for="last_name">نام خانوادگی <span class="required">*</span></label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="نام خانوادگی خود را وارد کنید"
                        value="<?php echo e($oldFormData['last_name'] ?? ''); ?>">
                    <?php if (array_key_exists('last_name', $errors)) : ?>
                        <div class="field-error"><?php echo e($errors['last_name'][0]); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group <?php echo array_key_exists('email', $errors) ? 'has-error' : ''; ?>">
                <label for="email">آدرس ایمیل <span class="required">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder=""
                    value="<?php echo e($oldFormData['email'] ?? ''); ?>">
                <?php if (array_key_exists('email', $errors)) : ?>
                    <div class="field-error"><?php echo e($errors['email'][0]); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group <?php echo array_key_exists('phone', $errors) ? 'has-error' : ''; ?>">
                <label for="phone">شماره تلفن همراه <span class="required">*</span></label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="09123456789"
                    value="<?php echo e($oldFormData['phone'] ?? ''); ?>">
                <?php if (array_key_exists('phone', $errors)) : ?>
                    <div class="field-error"><?php echo e($errors['phone'][0]); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group <?php echo array_key_exists('password', $errors) ? 'has-error' : ''; ?>">
                <label for="password">رمز عبور <span class="required">*</span></label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="حداقل ۸ کاراکتر"
                    minlength="8">
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <div class="strength-text" id="strengthText">یک رمز عبور ایمن وارد کنید</div>
                <?php if (array_key_exists('password', $errors)) : ?>
                    <div class="field-error"><?php echo e($errors['password'][0]); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group <?php echo array_key_exists('confirm_password', $errors) ? 'has-error' : ''; ?>">
                <label for="confirm_password">تکرار رمز عبور <span class="required">*</span></label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="رمز عبور را دوباره وارد کنید">
                <?php if (array_key_exists('confirm_password', $errors)) : ?>
                    <div class="field-error"><?php echo e($errors['confirm_password'][0]); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group checkbox <?php echo array_key_exists('terms', $errors) ? 'has-error' : ''; ?>">
                <input <?php echo $oldFormData['terms'] ?? false ? 'checked' : '' ?>
                    type="checkbox"
                    id="terms"
                    name="terms">
                <label for="terms">
                    من با <a href="/terms" target="_blank">شرایط و قوانین</a> موافقم
                </label>
                <?php if (array_key_exists('terms', $errors)) : ?>
                    <div class="field-error"><?php echo e($errors['terms'][0]); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group checkbox">
                <input
                    type="checkbox"
                    id="newsletter"
                    name="newsletter"
                    value="1">
                <label for="newsletter">
                    مشترک خبرنامه شوید تا از به‌روزرسانی‌ها و پیشنهادها مطلع شوید
                </label>
            </div>

            <button type="submit" class="btn-register button-link">ثبت نام</button>

            <div class="divider">
                <span>یا</span>
            </div>

            <div class="form-footer">
                قبلاً ثبت‌نام کرده‌اید؟ <a href="/login">ورود</a>
            </div>
        </form>
    </section>
</main>

<script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    // Grab the container that holds the progress bar
    const strengthContainer = document.querySelector('.password-strength');

    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z\d]/.test(password)) strength++;
        return strength;
    }

    passwordInput.addEventListener('input', function() {
        // --- NEW: Hide when empty, show when typing ---
        if (this.value.length === 0) {
            strengthContainer.style.display = 'none';
            strengthText.style.display = 'none';
            return; // Stop running the rest of the function
        } else {
            strengthContainer.style.display = 'block';
            strengthText.style.display = 'block';
        }
        // ----------------------------------------------

        const strength = checkPasswordStrength(this.value);
        const percentage = (strength / 5) * 100;

        strengthBar.style.width = percentage + '%';
        strengthBar.className = 'password-strength-bar';

        if (strength <= 2) {
            strengthBar.classList.add('strength-weak');
            strengthText.textContent = 'رمز ضعیف';
        } else if (strength <= 3) {
            strengthBar.classList.add('strength-medium');
            strengthText.textContent = 'قدرت متوسط';
        } else {
            strengthBar.classList.add('strength-strong');
            strengthText.textContent = 'رمز قوی';
        }
    });

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            alert('رمزهای عبور مطابقت ندارند!');
            confirmPasswordInput.focus();
        }
    });
</script>
<?php include $this->resolve("layouts/footer.php"); ?>