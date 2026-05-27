<?php

declare(strict_types=1);

namespace Core;

class Controller
{
    private array $globalControllerData = [];


    public function __construct(private string $basePath) {}

    public function render(string $controller, array $data = [])
    {
        extract($data, EXTR_SKIP);
        extract($this->globalControllerData, EXTR_SKIP);

        ob_start();

        include $this->resolve($controller);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }

    public function addGlobal(string $key, mixed $value)
    {
        $this->globalControllerData[$key] = $value;
    }
}
