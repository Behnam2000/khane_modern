<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;
use Core\Controller;
use Model\UserService;

class AuthContextMiddleware implements MiddlewareContract
{
    public function __construct(
        private Controller $controller,
        private UserService $userService
    ) {}

    public function process(callable $callback)
    {
        if (!empty($_SESSION['user'])) {
            $this->controller->addGlobal(
                'currentUser',
                $this->userService->findById((int) $_SESSION['user'])
            );
        }

        $callback();
    }
}
