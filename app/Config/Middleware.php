<?php

declare(strict_types=1);

namespace Config;

use Core\App;
use Middleware\{
    ControllerMiddleware,
    FlashMiddleware,
    SessionMiddleware,
    ValidationExceptionMiddleware,
    CsrfGuardMiddleware,
    CsrfTokenMiddleware,
    AuthContextMiddleware
};

function registerMiddleware(App $app)
{
    $app->addMiddleware(SessionMiddleware::class);
    $app->addMiddleware(AuthContextMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(ControllerMiddleware::class);
    $app->addMiddleware(CsrfTokenMiddleware::class);
    $app->addMiddleware(CsrfGuardMiddleware::class);
}
