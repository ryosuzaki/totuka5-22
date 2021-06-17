<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    //
    protected $guarded = ['id','name'];

    
    //
    public static function findByName($name){
        return parent::where('name',$name)->first();
    }


    //
    public function groups(){
        return $this->hasMany('App\Models\Group\GroupType','group_type_id');
    }

}
