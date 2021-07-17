<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use App\Traits\InfoFuncs;
use App\Traits\RecieveAnnouncement;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use InfoFuncs{
        InfoFuncs::createInfoBase as trait_createInfoBase;
    }

    //RecieveAnnouncementにはNotifiable必須
    use Notifiable;
    use RecieveAnnouncement;

    //
    protected $guarded=[];

    //
    protected $hidden = [
         'remember_token','password'
    ];

    protected $dates = [
        'last_used',
    ];

    //
    public static function findByEmail(string $email){
        return parent::where('email',$email)->first();
    }

    //
    public static function setUp(string $name,string $email,string $password){
        $user=User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $user->createInfoBase(4);
        return $user;
    }

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
    public function joinGroup(int $group_id,$role,string $password){
        $group=Group::find($group_id);
        if($group->getRole($role)->checkPassword($password)){
            return $group->inviteUser($this->id,$role);
        }
    }
    //
    public function leaveGroup(int $group_id){
        $group=Group::find($group_id);
        return $group->removeUser($this->id);
    }


    //
    public function hasRoleInGroup($role,int $group_id){
        if (is_string($role)) {
            return $this->rolesThroughGroup()->wherePivot('group_id',$group_id)->get()->contains('role_name',$role);
        }elseif(is_int($role)){
            return $this->rolesThroughGroup()->wherePivot('group_id',$group_id)->get()->contains('id',$role);
        }
    }
    //
    public function getRoleByGroup(int $group_id){
        return $this->rolesThroughGroup()->wherePivot('group_id',$group_id)->first();
    }


    //
    public function rolesThroughGroup(){
        return $this->belongsToMany(
            config('kaigohack.role.namespace'),'group_role_user','user_id','role_id'
        )->withPivot('group_id')->withTimestamps();
    }
    
    //
    public function groupsHaveType($type){
        $type=GroupType::findByIdOrName($type);
        $out=[];
        foreach($this->groups()->get() as $group){
            if($group->group_type_id==$type->id){
                $out[]=$group;
            }
        }
        return collect($out);
    }

    //
    public function groupTypes(){
        $types=[];
        foreach($this->groups()->get() as $group){
            $types[]=$group->getType();
        }
        return collect(array_unique($types));
    }
    //
    public function useGroupType($type){
        $type=GroupType::findByIdOrName($type);
        $ids=collect($type->user_info)->diff($this->infoBases()->pluck('info_template_id'));
        foreach($ids as $id){
            $this->createInfoBase($id);
        }
        return $ids;
    }




    //
    public function groupsRequestJoin(){
        return $this->belongsToMany(
            'App\Models\Group\Group','group_join_requests','user_id','group_id'
        )->withPivot('role_id')->withTimestamps();
    }
    //
    public function countGroupsRequestJoin(){
        return $this->groupsRequestJoin()->get()->count();
    }

    //
    public function acceptJoinRequest(int $group_id){
        if($this->hasGroup($group_id)){
            $this->leaveGroup($group_id);
        }
        $group=$this->groupsRequestJoin()->find($group_id);
        $role_id=$group->pivot->role_id;
        $group->inviteUser($this->id,$role_id);
        return $this->groupsRequestJoin()->detach($group_id);
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




    //
    public function createInfoBase(int $template_id){
        if($this->hasInfoBase($template_id)){
            return $this->getInfoBaseByTemplate($template_id);
        }else{
            return $this->trait_createInfoBase($template_id);
        }
    }
}
