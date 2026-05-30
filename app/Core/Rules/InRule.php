<?php

declare(strict_types=1);

namespace Core\Rules;

use Contracts\RuleContract;

class InRule implements RuleContract
{
    public function validate(array $data, string $field, array $params): bool
    {
        return in_array($data[$field], $params);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Invalid Selection";
    }
}
