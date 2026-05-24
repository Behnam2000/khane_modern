<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class HomeController
{
    private Controller $controller;

    public function __construct()
    {
        $this->controller = new Controller();
    }

    public function index()
    {
        $this->controller->render('home', [
            'title' => 'خانه'
        ]);
    }
}
