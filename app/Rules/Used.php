<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Used implements Rule
{
    private $valid = 0;
    private $invalid = 0;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($valid, $invalid)
    {
        $this->valid = $valid;
        $this->invalid = $invalid;
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
        return $value == $this->valid + $this->invalid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Zbir Vazeći i Nevazeći ne odgovara unijetim podacima u Upotrijebljeno';
    }
}
