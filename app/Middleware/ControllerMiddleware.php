<?php

declare(strict_types=1);

namespace Middleware;

use Contracts\MiddlewareContract;
use Core\Controller;

class ControllerMiddleware implements MiddlewareContract
{
    public function __construct(private Controller $view) {}

    public function process(callable $callback)
    {
        $this->view->addGlobal('title', 'خانه مدرن - خوش آمدید');

        $callback();
    }
}
