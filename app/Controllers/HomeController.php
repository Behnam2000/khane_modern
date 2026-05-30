<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class HomeController
{
    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('home.php', [
            'title' => '  خانه مدرن | صفحه اصلی',
            'page' => ' اصلی (خانه)'
        ]);
    }
}
