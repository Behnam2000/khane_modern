<?php

namespace Routes;

use Core\App;
use Controllers\{HomeController, AboutController};


function addRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/about', [AboutController::class, 'about']);
}
