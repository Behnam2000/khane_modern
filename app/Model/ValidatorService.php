<?php

declare(strict_types=1);

namespace Model;

use Core\Rules\{
    RequiredRule,
    EmailRule,
    PhoneRule,
    InRule,
    MatchRule
};
use Core\Validator;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('emailValidation', new EmailRule());
        $this->validator->add('phoneValidation', new PhoneRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('match', new MatchRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'emailValidation'],
            'phone' => ['required', 'phoneValidation'],
            'password' => ['required'],
            'confirm_password' => ['required', 'match:password'],
            'terms' => ['required']
        ]);
    }

    public function validateReview(array $formData)
    {
        $this->validator->validate($formData, [
            'body' => ['required'],
            'rating' => ['required', 'in:1,2,3,4,5'],
        ]);
    }

    public function validateLogin(array $loginFormData)
    {
        $this->validator->validate($loginFormData, [
            'phone' => ['required'],
            'password' => ['required']
        ]);
    }

    public function validateProfile(array $formData)
    {
        $this->validator->validate($formData, [
            'phone' => ['required'],
            'email' => ['required', 'emailValidation']
        ]);
    }
}
