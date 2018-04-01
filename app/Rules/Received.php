<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Received implements Rule
{
    private $used = 0;
    private $unused = 0;
    private $registeredCheck = 0;

    /**
     * Create a new rule instance.
     * @param  mixed  $used
     * @param  mixed  $unused
     * @return void
     */
    public function __construct($used, $unused, $registeredCheck)
    {
        $this->used = $used;
        $this->unused = $unused;
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
        return $value == $this->used + $this->unused && $value == $this->registeredCheck;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Primljeno mora biti jednako zbiru Upotrijebljeno i Neupotrijebljeno i Upisano';
    }
}
