<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class ChidemanController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('chideman.php', [
            'title' => 'چیدمان',
        ]);
    }
}
