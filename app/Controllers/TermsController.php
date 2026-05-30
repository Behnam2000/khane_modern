<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class TermsController
{

    public function __construct(private Controller $controller) {}

    public function index()
    {
        echo $this->controller->render('terms.php', [
            'title' => 'قوانین و شرایط - خانه مدرن',
        ]);
    }
}
