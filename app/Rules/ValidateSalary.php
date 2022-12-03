<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidateSalary implements InvokableRule
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
        if(!strlen($value)) $fail('The :attribute should not be empty!');

        if(str_contains($value, ',')){

        $valueArray = explode(',', $value);
        
        if(strlen($valueArray[1]) > 3 ) $fail('The :attribute has wrong decimal format!');

        if((integer)$valueArray[0] > 500) {
                   if((integer)$valueArray[1] > 0) $fail('The :attribute is larger then 500!');
                   $fail('The :attribute is larger then 500');
             }

        if((integer)$valueArray[0] < 0) $fail('The :attribute has negative value!');

        }

        if((integer)$value > 500) $fail('The :attribute is larger then 500!');
        if((integer)$value < 0 ) $fail('The :attribute has negative value!');
  
    }
}
