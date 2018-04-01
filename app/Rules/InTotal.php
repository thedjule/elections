<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InTotal implements Rule
{
    private $used = 0;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($used)
    {
        $this->used = $used;
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
        return $value == $this->used;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Upotrijebljeno mora biti jednako Ukupno';
    }
}
