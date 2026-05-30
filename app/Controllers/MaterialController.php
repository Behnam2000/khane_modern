<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class MaterialController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('material.php', [
            'title' => 'متریال و سلیقه ها',
        ]);
    }
}
