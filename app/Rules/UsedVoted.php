<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UsedVoted implements Rule
{
    private $votedOutOfThePollingStation = 0;
    private $votedAtThePollingStation = 0;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($votedAtThePollingStation, $votedOutOfThePollingStation)
    {
        $this->votedAtThePollingStation = $votedAtThePollingStation;
        $this->votedOutOfThePollingStation = $votedOutOfThePollingStation;
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
        return $value == $this->votedAtThePollingStation + $this->votedOutOfThePollingStation;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Zbir Glasali na biračkom mjestu i Glasali van biračkog mjesta ne odgovara unijetim podacima u Upotrijebljeno';
    }
}
