<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    public function networks()
    {
        return $this->belongsToMany('App\Networks');
    }
}
