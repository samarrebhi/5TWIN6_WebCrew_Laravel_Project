<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoBadWords implements Rule
{
    protected $badWords = ['fuck', 'wtf', 'bad'];  

    public function passes($attribute, $value)
    {
        foreach ($this->badWords as $badWord) {
            if (stripos($value, $badWord) !== false) {
                return false;  
            }
        }
        return true;
    }

    public function message()
    {
        return 'Your comment contains inappropriate language.';
    }
}
