<?php

declare(strict_types=1);

namespace Core\Rules;

use Contracts\RuleContract;

class EmailRule implements RuleContract
{
    public function validate(array $data, string $field, array $params): bool
    {
        return (bool) filter_var($data[$field], FILTER_VALIDATE_EMAIL);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "ایمیل اشتباه است";
    }
}
