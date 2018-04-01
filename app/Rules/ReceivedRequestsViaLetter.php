<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReceivedRequestsViaLetter implements Rule
{
    private $votersNotAllowedToVoteByLetter = 0;
    private $votersAllowedToVoteByLetter = 0;
    /**
     * Create a new rule instance.
     * @param  mixed  $votersAllowedToVoteByLetter
     * @param  mixed  $votersNotAllowedToVoteByLetter
     * @return void
     */
    public function __construct($votersAllowedToVoteByLetter, $votersNotAllowedToVoteByLetter)
    {
        $this->votersAllowedToVoteByLetter = $votersAllowedToVoteByLetter;
        $this->votersNotAllowedToVoteByLetter = $votersNotAllowedToVoteByLetter;
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
        return $value == $this->votersNotAllowedToVoteByLetter + $this->votersAllowedToVoteByLetter;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Broj Primljenih zahtjeva putem pisma ne odgovara zbiru Omogućeno biračima da glasaju putem pisma i Nije omogućeno biračima da glasaju putem pisma';
    }
}
