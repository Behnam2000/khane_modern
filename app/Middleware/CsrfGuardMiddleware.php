<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;

class CsrfGuardMiddleware implements MiddlewareContract
{
    public function process(callable $callback)
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);

        $validMethods = ['POST', 'PATCH', 'DELETE'];

        if (!in_array($requestMethod, $validMethods)) {
            $callback();
            return;
        }

        if ($_SESSION['token'] !== $_POST['token']) {
            redirectTo('/login');
        }

        unset($_SESSION['token']);

        $callback();
    }
}
