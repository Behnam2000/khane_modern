<?php

declare(strict_types=1);

namespace Core\Rules;

use Contracts\RuleContract;

class PhoneRule implements RuleContract
{
    public function validate(array $data, string $field, array $params): bool
    {
        return (bool) preg_match('#^(?:\+98|0)9\d{9}$#', $data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "شماره تلفن همراه اشتباه است";
    }
}
