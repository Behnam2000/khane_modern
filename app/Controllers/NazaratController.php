<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Model\{ReviewService, ValidatorService};

class NazaratController
{
    public function __construct(
        private Controller $controller,
        private ReviewService $reviewService,
        private ValidatorService $validatorService
    ) {}

    public function index()
    {
        echo $this->controller->render('nazarat.php', [
            'title'   => 'نظرات و پیشنهادات',
            'reviews' => $this->reviewService->approved(),
        ]);
    }

    public function addComment()
    {
        $this->validatorService->validateReview($_POST);

        $this->reviewService->create(
            (int) $_SESSION['user'],
            trim($_POST['body']),
            (int) $_POST['rating']
        );

        $_SESSION['success'] = 'نظر شما ثبت شد و پس از تأیید مدیر نمایش داده می‌شود.';
        redirectTo('/nazarat');
    }
}
