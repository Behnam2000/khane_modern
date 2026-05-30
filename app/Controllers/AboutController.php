<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class AboutController
{

    public function __construct(private Controller $controller) {}

    public function about()
    {
        echo $this->controller->render('about.php', [
            'title' => 'درباره ما',
            'page' => 'درباره ما'
        ]);
    }
}
