<?php

declare(strict_types=1);

namespace Core;

use Core\ValidationException;
use Contracts\RuleContract;

class Validator
{
    private array $rules = [];

    public function add(string $alias, RuleContract $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $formData, array $fields)
    {
        $errors = [];

        foreach ($fields as $field => $rules) {
            foreach ($rules as $rule) {
                $ruleParams = [];

                if (str_contains($rule, ':')) {
                    [$rule, $ruleParams] = explode(':', $rule);
                    $ruleParams = explode(',', $ruleParams);
                }

                $ruleValidator = $this->rules[$rule];

                if ($ruleValidator->validate($formData, $field, $ruleParams)) {
                    continue;
                }

                $errors[$field][] = $ruleValidator->getMessage($formData, $field, $ruleParams);
            }
        }

        if (count($errors)) {
            throw new ValidationException($errors);
        }
    }
}
