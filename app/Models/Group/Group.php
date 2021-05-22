<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $guarded = [];

    //
    public function users(){
        return $this->belongsToMany(
            'App\User','group_users','group_id','user_id'
        )->using('App\Models\Group\GroupUser');
    }
    //
    public function roles(){
        return $this->hasMany('App\Models\Group\GroupRole','group_id');
    }
    //
    public function infoBases(){
        return $this->belongsToMany(
            'App\Models\Group\GroupInfoBase','group_infos','group_id','base_id'
        )->withPivot('updated_by','info')->using('App\Models\Group\GroupInfo');
    }

    public function location(){
        return $this->hasOne('App\Models\Group\GroupLocation', 'group_id');
    }
}
