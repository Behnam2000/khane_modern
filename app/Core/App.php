<?php

declare(strict_types=1);

namespace Core;


class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $difinitionPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($difinitionPath) {
            $definitions = include $difinitionPath;
            $this->container->addDefinitions($definitions);
        }
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, array $controller, array $middleware = []): App
    {
        $this->router->add($path, "GET", $controller, $middleware);

        return $this;
    }

    public function post(string $path, array $controller, array $middleware = []): App
    {
        $this->router->add($path, "POST", $controller, $middleware);

        return $this;
    }

    public function addMiddleware(string $middleware): App
    {
        $this->router->addMiddleware($middleware);

        return $this;
    }

    public function add(string $middleware): App
    {
        $this->router->addRouteMiddleware($middleware);

        return $this;
    }
}
