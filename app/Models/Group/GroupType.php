<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    //
    protected $guarded = ['id','name'];
    //
    protected $casts = [
        'required_info'=>'json',
        'user_info'=>'json',
        'creator_permissions'=>'json',
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
        return $this->hasMany('App\Models\Group\GroupType','group_type_id');
    }

}
