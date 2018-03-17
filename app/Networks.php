<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Networks extends Model
{
    protected $fillable = ['network_id', 'auth', 'throughput', 'device_id'];

    public function devices()
    {
        return $this->belongsToMany('App\Devices','networks_devices', 'network_id','device_id');
    }
    
    public function scopeNetworkExist($query, $network_id)
    {

        return $query->where('network_id', '=', $network_id)->count();
    }
    
    public function scopeSaveNetwork($query, $model)
    {

    }
    
}
