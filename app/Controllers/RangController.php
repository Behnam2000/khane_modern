<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class RangController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('rang.php', [
            'title' => 'رنگ آمیزی',
        ]);
    }
}
