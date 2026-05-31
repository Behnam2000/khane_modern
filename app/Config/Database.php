<?php

declare(strict_types=1);

namespace Config;

final class Database
{
    public static function config(): array
    {
        return [
            'driver'   => env('DB_DRIVER', 'mysql'),
            'host'     => env('DB_HOST', 'localhost'),
            'port'     => (int) env('DB_PORT', '3306'),
            'dbname'   => env('DB_NAME', 'modern'),
            'username' => env('DB_USER', 'root'),
            'password' => env('DB_PASS', ''),
        ];
    }
}
