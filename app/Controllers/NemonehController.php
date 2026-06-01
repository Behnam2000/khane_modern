<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Model\PicService;

class NemonehController
{
    public function __construct(
        private Controller $controller,
        private PicService $picService
    ) {}

    public function index()
    {
        echo $this->controller->render('nemoneh.php', [
            'title' => 'نمونه کار ها',
            'pics'  => $this->picService->active(),
        ]);
    }
}
