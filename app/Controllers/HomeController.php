<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Config\Paths;

class HomeController
{
    private Controller $controller;

    public function __construct()
    {
        $this->controller = new Controller(Paths::VIEWS);
    }

    public function index()
    {
        echo $this->controller->render('home.php', [
            'title' => '  خانه مدرن | صفحه اصلی',
            'page' => ' اصلی (خانه)'
        ]);
    }
}
