<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;

class AuthRequiredMiddleware implements MiddlewareContract
{
    public function process(callable $callback)
    {
        if (empty($_SESSION['user'])) {
            redirectTo('/login');
        }

        $callback();
    }
}
