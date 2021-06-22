<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Group\Group;

use App\Traits\InfoFuncs;

use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use InfoFuncs;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token','password'
    ];

    protected $dates = [
        'last_used',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];




    //
    public function groups(){
        return $this->belongsToMany(
            'App\Models\Group\Group','group_role_user','user_id','group_id'
        )->withPivot('role_id')->withTimestamps();
    }
    //
    public function hasGroup(int $id){
        return $this->groups()->get()->contains('id',$id);
    }
    //
    public function getGroup(int $id){
        return $this->groups()->find($id);
    }


    //
    //
    public function joinGroup(int $group_id,$role,string $password){
        $group=Group::find($group_id);
        if($group->getGroupRole($group_id)->checkPassword($password)){
            return $group->inviteUser($this->id,$role);
        }
    }
    //
    public function leaveGroup(int $group_id){
        $group=Group::find($group_id);
        return $group->removeUser($this->id);
    }


    //
    public function hasGroupRole(int $group_id,$role){
        if (is_string($role)) {
            return $this->groupRoles()->wherePivot('group_id',$group_id)->get()->contains('name',$role);
        }elseif(is_int($role)){
            return $this->groupRoles()->wherePivot('group_id',$group_id)->get()->contains('id',$role);
        }
    }
    //
    public function getGroupRole(int $group_id){
        return $this->groupRoles()->wherePivot('group_id',$group_id)->first();
    }
    //
    public function getRole(int $group_id){
        return $this->getGroupRole($group_id)->getRole();
    }
    //
    public function hasGroupPermissionTo(int $group_id,$permission){
        return $this->getRole($group_id)->hasPermissionTo($permission);
    }


    //
    public function groupRoles(){
        return $this->belongsToMany(
            'App\Models\Group\GroupRole','group_role_user','user_id','role_id'
        )->withPivot('group_id')->withTimestamps();
    }
    
    //
    public function groupsHaveType(string $type){
        $groups=$this->groups()->get();
        $out=[];
        foreach($groups as $group){
            if($group->getTypeName()==$type){
                $out[]=$group;
            }
        }
        return $out;
    }
    //
    public function groupTypes(){
        $groups=$this->groups()->get();
        $types=[];
        foreach($groups as $group){
            $types[]=$group->getType();
        }
        return array_unique($types);
    }

    

    //
    public function answers(){
        return $this->hasMany('App\Models\Questionnaire\Answer','user_id');
    }




    //
    public function groupsRequestJoin(){
        return $this->belongsToMany(
            'App\Models\Group\Group','group_join_requests','user_id','group_id'
        )->withPivot('role_id')->withTimestamps();
    }
    //
    public function acceptJoinRequest(int $group_id){
        $group=$this->groupsRequestJoin()->find($group_id);
        $role_id=$group->pivot()->role_id;
        return $group->inviteUser($this->id,$role_id);
    }
    //
    public function deniedJoinRequest(int $group_id){
        return $this->groupsRequestJoin()->detach($group_id);
    }




    //
    public function extraGroups(){
        return $this->belongsToMany(
            'App\Models\Group\Group','extra_group_users','user_id','group_id'
        )->withPivot('name')->withTimestamps();
    }
    //
    public function attachExtraGroup(int $group_id,string $extra_name){
        return $this->extraGroups()->attach($group_id,['name'=>$extra_name]);
    }
    //
    public function detachExtraGroup(int $group_id,string $extra_name){
        return $this->extraGroups()->wherePivot('name',$extra_name)->detach($group_id);
    }
    //
    public function hasExtraGroup(int $group_id,string $extra_name){
        return $this->extraGroups()->wherePivot('name',$extra_name)->get()->contains('id',$group_id);
    }
}
