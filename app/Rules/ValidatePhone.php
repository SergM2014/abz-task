<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidatePhone implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $error = '';
        if(!strlen($value)) $fail('The :attribute should not be empty');

        if (!preg_match('/^([\+]\d{2}[\(]\d{3}[\)]\d{7})$/', $value)
            AND !preg_match('/^([\+]\d{2}[\(]\d{5}[\)]\d{5})$/', $value)
            AND !preg_match('/^([\+]\d{2}[\(]\d{4}[\)]\d{6})$/', $value)
            AND !preg_match('/^\d{10}$/', $value)
            AND !preg_match('/^\d{7}$/', $value)
        ) $error = 'format is not corect!';

        if($error) $fail('The :attribute '.$error);
    }
}
