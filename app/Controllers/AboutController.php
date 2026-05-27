<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Config\Paths;

class AboutController
{
    private Controller $controller;

    public function __construct()
    {
        $this->controller = new Controller(Paths::VIEWS);
    }

    public function about()
    {
        echo $this->controller->render('about.php', [
            'title' => 'درباره ما',
            'page' => 'درباره ما'
        ]);
    }
}
