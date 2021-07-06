<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

class InfoTemplate extends Model
{
    //
    protected $guarded=[];
    //
    protected $casts = [
        'default' => 'array',
    ];

    //
    public $incrementing = false; 
    
    //
    public function infoBases(){
        return $this->hasMany('App\Models\Info\InfoBase','info_template_id');
    }

    //
    public function model(){
        return $this->model;
    }

    //
    public function setDefaultAttribute($value){
        $this->attributes['default'] = serialize($value);
    }
    //
    public function getDefaultAttribute($value){
        return unserialize($value);
    }
}
