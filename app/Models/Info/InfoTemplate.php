<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

class InfoTemplate extends Model
{
    //
    protected $guarded=[];
    //
    protected $casts = [
        'default' => 'json',
    ];

    //
    public $incrementing = false; 
    
    //
    public function infoBases(){
        return $this->hasMany('App\Models\Info\InfoBase','info_template_id');
    }
}
