<?php

declare(strict_types=1);

namespace App\Core;

class Controller
{
    public function render(string $path, array $data = [])
    {
        extract($data, EXTR_SKIP);

        $output = include __DIR__ . "/../Controllers/{$path}.php";

        return $output;
    }
}
