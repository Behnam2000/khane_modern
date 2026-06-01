<?php

declare(strict_types=1);

namespace Middleware;

use Core\SessionException;
use Contracts\MiddlewareContract;


class SessionMiddleware implements MiddlewareContract
{
    public function process(callable $callback)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session is already active");
        }

        if (headers_sent($filename, $line)) {
            throw new SessionException("Headers already sent. Consider enabling output-buffering. Data outputed from {$filename} - Line: {$line}.");
        }

        $appEnv = $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?: 'development';

        session_set_cookie_params([
            'secure' => $appEnv === 'production',
            'httponly' => true,
            'samesite' => 'lax',
        ]);

        session_start();

        $callback();

        session_write_close();
    }
}
