<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultPollingStation extends Model
{
    /**
     * Get the Municipality that owns the Polling Station.
     */
    public function defaultMunicipality()
    {
        return $this->belongsTo('App\DefaultMunicipality');
    }
}
