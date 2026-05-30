<?php

declare(strict_types=1);

namespace Core;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(public array $errors, int $code = 322)
    {
        parent::__construct(code: $code);
    }
}
