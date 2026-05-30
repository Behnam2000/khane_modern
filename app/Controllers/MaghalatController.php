<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class MaghalatController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('maghalat.php', [
            'title' => 'مقالات و مجله ها',
        ]);
    }
}
