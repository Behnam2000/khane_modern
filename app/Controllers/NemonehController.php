<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class NemonehController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('nemoneh.php', [
            'title' => 'نمونه کار ها',
        ]);
    }
}
