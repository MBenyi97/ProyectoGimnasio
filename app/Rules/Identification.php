<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Identification implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (preg_match('/(^[0-9]{8}[A-Za-z]{1}$)/', $value)) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The dni must be have 8 numbers and 1 letter.';
    }
}
