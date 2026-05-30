<?php

declare(strict_types=1);

namespace Core\Rules;

use Contracts\RuleContract;

class RequiredRule implements RuleContract
{
    public function validate(array $data, string $field, array $params): bool
    {
        return !empty($data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "این قسمت را وارد کنید";
    }
}
