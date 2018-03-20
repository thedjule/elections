<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingStation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'received_requests_via_letter',
        'voters_allowed_to_vote_by_letter',
        'voters_not_allowed_to_vote_by_letter',
        'received',
        'unused',
        'used',
        'control_coupons',
        'trim_confirmations',
        'valid',
        'invalid',
        'registered',
        'registered_check',
        'voted_at_the_polling_station',
        'voted_out_of_the_polling_station',
        'in_total',
        'valid_save'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];

    /**
     * Get the Municipality that owns the Polling Station.
     */
    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }

    public function electoralLists()
    {
        return $this->belongsToMany('App\ElectoralList')->withPivot('votes');
    }

    /**
     * Get the User that is assigned to the Polling Station.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
