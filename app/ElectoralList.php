<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectoralList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'name'
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
     * Get the Election that owns the Electoral List.
     */
    public function election()
    {
        return $this->belongsTo('App\Election');
    }

    public function pollingStations()
    {
        return $this->belongsToMany('App\PollingStation')->withPivot('votes');
    }
}
