<?php

declare(strict_types=1);

namespace Core\Rules;

use Contracts\RuleContract;

class MatchRule implements RuleContract
{
    public function validate(array $data, string $field, array $params): bool
    {
        $fieldOne = $data[$field];
        $fieldTwo = $data[$params[0]];

        return $fieldOne === $fieldTwo;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "رمز عبور یکسان نیستند";
    }
}
