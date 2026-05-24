<?php

declare(strict_types=1);

namespace Core;

class Router
{
    private array $routes = [];

    public function addRoute(string $method, string $path, array $controller)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $this->normalizePath($path),
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

    public function dispatch(string $path, string $method)
    {
        $method = strtoupper($method);
        $path = $this->normalizePath($path);

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
            }

            [$class, $function] = $route['controller'];

            $controllerInstance = new $class();

            $controllerInstance->$function();
        }
    }
}
