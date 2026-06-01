<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;

class AdminOnlyMiddleware implements MiddlewareContract
{
    public function process(callable $callback)
    {
        if (empty($_SESSION['user'])) {
            redirectTo('/login');
        }

        if (($_SESSION['role'] ?? '') !== 'admin') {
            redirectTo('/');
        }

        $callback();
    }
}
