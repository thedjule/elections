<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UsedCoupons implements Rule
{
    private $controlCoupons = 0;
    private $trimConfirmations = 0;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($controlCoupons, $trimConfirmations)
    {
        $this->controlCoupons = $controlCoupons;
        $this->trimConfirmations = $trimConfirmations;
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
        return $value == $this->trimConfirmations && $value == $this->controlCoupons;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Upotrijebljeno mora biti jednak Broju Kontrolnih kupona i Odrezaka potvrda';
    }
}
