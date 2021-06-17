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
        )->withPivot('role_id')->using('App\Models\Group\GroupUser');
    }
    //
    public function hasGroup(int $id){
        return $this->groups()->get()->contains('id',$id);
    }
    //
    //
    public function joinGroup(int $group_id,$role,string $password){
        $group=Group::find($group_id);
        if($group->hasRole($role_id)){
            if($group->groupRoles()->where('id',$role_id)->first()->checkPassword($password)){
                $this->assignRole($role_id);
                return $this->groups()->attach($group_id,['role_id'=>$role_id]);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    //
    public function leaveGroup(int $group_id){
        if($this->hasGroup($group_id)){
            $role_id=$this->groupRoles()->where('group_id',$group_id)->first()->id;
            $this->removeRole($role_id);
            return $this->groups()->detach($group_id);
        }else{
            return false;
        }
    }
    //
    public function hasGroupRole(int $group_id,string $role_name){
        return $this->hasRole('group'.$group_id.$role_name);
    }
    //
    public function getGroupRole(int $group_id){
        return $this->groupRoles()->find($group_id);
    }
    //
    public function getRoleId(int $group_id){
        return $this->getGroupRole($group_id)->pivot()->role_id;
    }


    //
    public function groupRoles(){
        return $this->belongsToMany(
            'App\Models\Group\GroupRole','group_role_user','user_id','role_id'
        )->withPivot('group_id')->using('App\Models\Group\GroupUser');
    }
    
    //
    public function groupsHaveType($type){
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
}
