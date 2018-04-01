<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Valid implements Rule
{
    private $lists = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($lists)
    {
        $this->lists = $lists;
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
        return $value == array_sum($this->lists);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Suma Lista ne odgovara unijetim podacima u Važeći';
    }
}
