<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    //
    protected $guarded = ['id','name'];
    //
    protected $casts = [
        'required_info'=>'array',
        'user_info'=>'array',
        'creator_permissions'=>'array',
    ];
    
    //
    public static function findByName($name){
        return parent::where('name',$name)->first();
    }
    //
    public static function findByIdOrName($type){
        if (is_string($type)) {
            return self::findByName($type);
        }elseif(is_int($type)){
            return self::find($type);
        }
    }


    //
    public function groups(){
        return $this->hasMany('App\Models\Group\Group','group_type_id');
    }




    //
    public function setRequiredInfoAttribute($value){
        $this->attributes['required_info'] = serialize($value);
    }
    //
    public function getRequiredInfoAttribute($value){
        return unserialize($value);
    }

    //
    public function setUserInfoAttribute($value){
        $this->attributes['user_info'] = serialize($value);
    }
    //
    public function getUserInfoAttribute($value){
        return unserialize($value);
    }


    //
    public function setCreaterPermissionsAttribute($value){
        $this->attributes['creator_permissions'] = serialize($value);
    }
    //
    public function getCreaterPermissionsAttribute($value){
        return unserialize($value);
    }


}
