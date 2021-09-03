<?php

namespace App\Traits;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

trait UseLocation
{
    //
    public function location(){
        return $this->morphOne('App\Models\Components\Location', 'model');
    }
    //
    public function getLocation(){
        return $this->location()->first();
    }
    //
    public function setLocation(float $latitude,float $longitude){
        return $this->getLocation()->fill([
            'latitude'=>$latitude,
            'longitude'=>$longitude,
        ])->save();
    }
    //
    public function isLocationSet(){
        return ($this->getLocation()->latitude||$this->getLocation()->longitude)?true:false;
    }
}