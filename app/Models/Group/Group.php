<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\Models\Group\GroupInfoBase;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'uploaded_files'  => 'json',
    ];
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
    public function infoBase($base_id){
        return $this->infoBases()->where('base_id',$base_id)->first();
    }
    //
    public function location(){
        return $this->hasOne('App\Models\Group\GroupLocation', 'group_id');
    }





    //
    public function attachUser($user_id,$role_id){
        return $this->users()->attach($user_id,[
            'role_id'=>$role_id,
            ]);
    }

    //
    public function detachUser($user_id){
        return $this->users()->detach($user_id);
    }

    //
    public function attachInfoBase($base_id)
    {
        return $this->infoBases()->attach($base_id,[
            'updated_by'=>Auth::id(),
            'info'=>GroupInfoBase::find($base_id)->default_info,
        ]);
        
    }
    //
    public function detachInfoBase($base_id)
    {
        return $this->infoBases()->detach($base_id);
    }
   
    //
    public function setLocation($latitude,$longitude){
        return $this->location()->fill([
            'latitude'=>$latitude,
            'longitude'=>$longitude,
        ])->save();
    }

    
}
