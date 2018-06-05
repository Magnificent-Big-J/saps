<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MustBeValideDate implements Rule
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
    protected function  isValidDate($date, $format= 'Y-m-d'){
        return $date == date($format, strtotime($date));
    }
    public function passes($attribute, $value)
    {


        if($this->isValidDate($value))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The date is not valid and the format must be yyyy-mm-dd.';
    }
}
