<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Model\{ValidatorService, UserService};

class AuthController
{
    public function __construct(
        private Controller $controller,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {}

    public function login()
    {
        $errors = $_SESSION['errors'] ?? null;
        $oldFormData = $_SESSION['oldFormData'] ?? [];

        // Clear the session data so it doesn't persist on refresh
        unset($_SESSION['errors']);
        unset($_SESSION['oldFormData']);

        echo $this->controller->render('login.php', [
            'title' => 'ورود به حساب کاربری',
            'errors' => $errors,
            'oldFormData' => $oldFormData
        ]);
    }

    public function loginSubmit()
    {
        $this->validatorService->validateLogin($_POST);
        $this->userService->login($_POST);
        redirectTo('/');
    }

    public function register()
    {
        $errors = $_SESSION['errors'] ?? null;
        $oldFormData = $_SESSION['oldFormData'] ?? [];

        // Clear the session data so it doesn't persist on refresh
        unset($_SESSION['errors']);
        unset($_SESSION['oldFormData']);

        echo $this->controller->render('register.php', [
            'title' => 'registeruser',
            'errors' => $errors,
            'oldFormData' => $oldFormData
        ]);
    }

    public function registerSubmit()
    {
        $this->validatorService->validateRegister($_POST);
        $this->userService->isPhoneTaken($_POST['phone']);
        $this->userService->create($_POST);

        $_SESSION['success'] = 'ثبت‌نام با موفقیت انجام شد.';
        redirectTo('/');
    }

    public function logout()
    {
        $this->userService->logout();
        redirectTo('/');
    }
}
