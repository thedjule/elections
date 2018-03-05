<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultMunicipality extends Model
{
    /**
     * Get the Polling Stations for the Municipality.
     */
    public function defaultPollingStations()
    {
        return $this->hasMany('App\DefaultPollingStation');
    }
}
