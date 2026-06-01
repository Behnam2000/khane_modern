<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;
use Core\Controller;

class FlashMiddleware implements MiddlewareContract
{
    public function __construct(private Controller $controller) {}

    public function process(callable $callback)
    {
        $this->controller->addGlobal('errors', $_SESSION['errors'] ?? []);
        unset($_SESSION['errors']);

        $this->controller->addGlobal('success', $_SESSION['success'] ?? null);
        unset($_SESSION['success']);

        $this->controller->addGlobal('oldFormData', $_SESSION['oldFormData'] ?? []);

        unset($_SESSION['oldFormData']);

        $callback();
    }
}
