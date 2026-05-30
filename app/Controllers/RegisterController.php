<?php

declare(strict_types=1);

namespace Controllers;

use Model\ValidatorService;
use Core\Controller;

class RegisterController
{
    public function __construct(
        private Controller $controller,
        private ValidatorService $validatorService
    ) {}

    public function register()
    {
        echo $this->controller->render('register.php', [
            'title' => 'registeruser',
        ]);
    }

    public function registerSubmit()
    {
        $this->validatorService->validateRegister($_POST);
    }
}
