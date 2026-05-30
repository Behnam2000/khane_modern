<?php

declare(strict_types=1);

namespace Config;

use Core\App;
use Middleware\ControllerMiddleware;
use Middleware\FlashMiddleware;
use Middleware\SessionMiddleware;
use Middleware\ValidationExceptionMiddleware;

function registerMiddleware(App $app)
{
    $app->addMiddleware(ControllerMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}
