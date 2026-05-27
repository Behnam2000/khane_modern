<?php

declare(strict_types=1);

namespace Core;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function add(string $path, string $method, array $controller)
    {
        $this->routes[] = [
            'path' => $this->normalizePath($path),
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    public function normalizePath(string $path)
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $method = strtoupper($method);
        $path = $this->normalizePath($path);

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
            }

            [$class, $function] = $route['controller'];

            $controllerInstance = $container ? $container->resolve($class) : new $class();

            $action = fn() => $controllerInstance->$function();

            foreach ($this->middlewares as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn() => $middlewareInstance->process($action);
            }

            $action();

            return;
        }
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
