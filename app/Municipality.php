<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Get the Polling Stations for the Municipality.
     */
    public function pollingStations()
    {
        return $this->hasMany('App\PollingStation');
    }

    /**
     * Get the Election that owns the Municipality.
     */
    public function election()
    {
        return $this->belongsTo('App\Election');
    }
}
