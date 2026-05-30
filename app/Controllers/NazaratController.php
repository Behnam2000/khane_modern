<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class NazaratController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('nazarat.php', [
            'title' => 'نظرات و پیشنهادات',
        ]);
    }
}
