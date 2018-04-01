<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Registered implements Rule
{
    private $registeredCheck = 0;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($registeredCheck)
    {
        $this->registeredCheck = $registeredCheck;
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
        return $value == $this->registeredCheck;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Upisano mora biti jednako Upisano provjera';
    }
}
