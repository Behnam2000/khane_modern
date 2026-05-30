<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class AuthController
{
    public function __construct(private Controller $controller) {}

    public function login()
    {
        echo $this->controller->render('login.php', [
            'title' => 'ورود به حساب کاربری',
        ]);
    }

    public function loginSubmit()
    {
        echo $this->controller->render('login.php', [
            'title' => 'ورود به حساب کاربری',
            'notice' => 'بخش احراز هویت بک‌اند هنوز متصل نشده است.',
        ]);
    }
}
