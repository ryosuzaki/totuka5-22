<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

use Wildside\Userstamps\Userstamps;

class Info extends Model
{
    //
    use Userstamps;
    //
    protected $guarded=['id'];
    //
    protected $casts = [
        'info'  => 'json',
    ];
    //
    public function infoBase(){
        return $this->belongsTo('App\Models\Info\InfoBase', 'info_base_id');
    }
    //
    public function infoBaseable(){
        return $this->infoBase()->infoBaseable();
    }
}
