<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\Models\Group\GroupInfoBase;
use App\User;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'data'  => 'json',
    ];
    //
    public static $types=[
        'shelter'=>'避難所',
        'danger_spot'=>'危険地点',
        'nursing_home'=>'介護事業者',
    ];
    public static function groupType($type){
        return self::$types[$type];
    }
        

    //
    public function users(){
        return $this->belongsToMany(
            'App\User','group_users','group_id','user_id'
        )->withPivot('role_id','data')->using('App\Models\Group\GroupUser');
    }
    public function usersHaveRank($rank){
        return $this->users()->where('role_id',$this->rank2role($rank)->id)->get();
    }
    public function usersHaveRole($role_id){
        return $this->users()->where('role_id',$role_id)->get();
    }

    public function user($user_id){
        return $this->users()->where('user_id',$user_id)->first();
    }
    //
    public function roles(){
        return $this->hasMany('App\Models\Group\GroupRole','group_id');
    }
    //
    public function role($role_id){
        return $this->roles()->where('id',$role_id)->first();
    }
    //
    public function rank2role($rank){
        return $this->roles()->where('rank',$rank)->first();
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
    public function attachRole(User $user,$rank){
        return $this->users()->attach($user->id,[
            'role_id'=>$this->rank2role($rank)->id,
            'data'=>[],
            ]);
    }
    //
    public function detachRole(User $user,$rank){
        return $this->users()->where('role_id',$this->rank2role($rank)->id)->detach($user->id);
    }
    //
    public function detachUser(User $user){
        return $this->users()->detach($user->id);
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
