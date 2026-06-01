<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;
use Core\Controller;


class CsrfTokenMiddleware implements MiddlewareContract
{
    public function __construct(private Controller $view) {}

    public function process(callable $callback)
    {
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));

        $this->view->addGlobal('csrfToken', $_SESSION['token']);

        $callback();
    }
}
