<?php /* Only show the footer if we are NOT on an auth page */ ?>
<?php if (($bodyClass ?? '') !== 'auth-body'): ?>
    <footer class="site-footer">
        <p>پروژه از هانیه باذلی</p>
        <p>© 2026 خانه ی مدرن. تمامی حقوق محفوظ است.</p>
        <p>صفحه <?php echo $page ?? ""; ?></p>
    </footer>
<?php endif; ?>

</body>

</html>