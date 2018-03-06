<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
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
     * Get the Election Type that owns the Election.
     */
    public function electionType()
    {
        return $this->belongsTo('App\ElectionType');
    }

    /**
     * Get the Municipalities for the Election.
     */
    public function municipalities()
    {
        return $this->hasMany('App\Municipality');
    }

    /**
     * Get the Electoral Lists for the Election.
     */
    public function electoralLists()
    {
        return $this->hasMany('App\ElectoralList');
    }
}
