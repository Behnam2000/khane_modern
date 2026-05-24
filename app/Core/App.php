<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Router;

class App
{
    private Router $router;

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($method, $path);
    }

    public function get(string $path, array $controller)
    {
        $this->router->addRoute("GET", $path, $controller);
    }
}
