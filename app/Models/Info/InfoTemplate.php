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
        'edit'=>'array',
    ];

    //
    public $incrementing = false;

    //
    public static function findByName(string $name,$model){
        return parent::where('name',$name)->first();
    }
    //
    public static function findByIdOrName($template,$model=null){
        if (is_string($template)&&$model!=null) {
            return self::findByName($template,get_class($model));
        }elseif(is_int($template)){
            return self::find($template);
        }else{
            throw new Exception("error!!!!");
        }
    }

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

    //
    public function setEditAttribute($value){
        $this->attributes['edit'] = serialize($value);
    }
    //
    public function getEditAttribute($value){
        return unserialize($value);
    }
}
