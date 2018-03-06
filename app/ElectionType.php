<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectionType extends Model
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
     * Get the Elections for the Election Type.
     */
    public function elections()
    {
        return $this->hasMany('App\Election');
    }
}
