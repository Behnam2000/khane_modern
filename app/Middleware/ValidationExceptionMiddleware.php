<?php

declare(strict_types=1);

namespace Middleware;

use Core\ValidationException;
use Contracts\MiddlewareContract;


class ValidationExceptionMiddleware implements MiddlewareContract
{

    public function process(callable $callback)
    {
        try {
            $callback();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;

            $excludedFields = ['password', 'confirm_password'];

            $formattedFormData = array_diff_key(
                $oldFormData,
                array_flip($excludedFields)
            );

            $_SESSION['errors'] = $e->errors;
            $_SESSION['oldFormData'] = $formattedFormData;

            session_write_close();

            $referer = $_SERVER['HTTP_REFERER'] ?? $_SERVER['REQUEST_URI'] ?? '/';
            redirectTo($referer);
        }
    }
}
