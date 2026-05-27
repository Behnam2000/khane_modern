<?php

declare(strict_types=1);

namespace Config;

use Core\App;
use Middleware\ControllerMiddleware;

function registerMiddleware(App $app)
{
    $app->addMiddleware(ControllerMiddleware::class);
}
