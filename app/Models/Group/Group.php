<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\Models\Info\InfoBase;

use App\User;

use App\Models\Group\GroupType;

use App\Traits\InfoFuncs;
use App\Traits\UploadImg;
use App\Traits\SendAnnouncement;

use App\Models\Upload\Image;
use Illuminate\Http\UploadedFile;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Group extends Model
{
    use InfoFuncs;
    use UploadImg{
        uploadImg::uploadImg as trait_uploadImg;
    }
    use SendAnnouncement;

    //
    protected $guarded = ['id','group_type_id'];
    //
    protected $casts = [
        'permissions'=>'array',
    ];
    





    //
    public function setPermissionsAttribute($value){
        $this->attributes['permissions'] = serialize($value);
    }
    //
    public function getPermissionsAttribute($value){
        return unserialize($value);
    }





    
    //
    public static function setUp(int $user_id,string $name,string $type){
        $type=GroupType::findByName($type);
        //
        $group=parent::create([
            'group_type_id'=>$type->id,
            'name'=>$name,
        ]);
        //
        $group->fill([
            'unique_name'=>config('kaigohack.unique_name').$group->id,
        ])->save();
        //
        if($type->need_location){
            $group->location()->create();
        }
        //
        foreach($type->required_info as $id){
            $group->createInfoBase($id);
        }
        //
        $creator=$group->createRole(config('kaigohack.creator'),$user_id);
        //
        $creator->syncPermissions($type->creator_permissions);
        //
        $group->inviteUser($user_id,config('kaigohack.creator'));
        //
        $group->refreshPermissions();
        return $group;
    }
    //
    public static function tearDown(int $group_id){
        return parent::destroy($group_id);
    }

    //
    public function refreshPermissions(){
        $permissions=[];
        $permissions[]='group.*';
        foreach(config('kaigohack.role.group') as $action){
            $permissions[]='group.'.$action;
        }
        $permissions[]='group_info_bases.*';
        foreach(config('kaigohack.role.group_info_bases') as $action){
            $permissions[]='group_info_bases.'.$action;
        }
        $permissions[]='group_info.*';
        foreach($this->infoBases()->get() as $base){
            $permissions[]='group_info.'.$base->index.'.*';
            foreach(config('kaigohack.role.group_info') as $action){
                $permissions[]='group_info.'.$base->index.'.'.$action;
            }
        }
        $permissions[]='group_roles.*';
        foreach(config('kaigohack.role.group_roles') as $action){
            $permissions[]='group_roles.'.$action;
        }
        $permissions[]='group_users.*';
        foreach($this->roles()->get() as $role){
            if($role->role_name!=config('kaigohack.creator')){
                $permissions[]='group_users.'.$role->index.'.*';
                foreach(config('kaigohack.role.group_users') as $action){
                    $permissions[]='group_users.'.$role->index.'.'.$action;
                }
            }
        }
        $this->fill([
            'permissions'=>$permissions,
        ])->save();
        return $permissions;
    }
    //
    public function refreshRoles(){
        $permissions=$this->refreshPermissions();
        foreach ($this->roles()->get() as $role){
            $role->syncPermissions($role->getAllPermissions()->pluck('name')->intersect($permissions));
        }
        return $this->roles()->get();
    }


    //
    public function users(){
        return $this->belongsToMany(
            config('auth.providers.users.model'),'group_role_user','group_id','user_id'
        )->withPivot('role_id')->withTimestamps();
    }
    //
    public function hasUser(int $id){
        return $this->users()->get()->contains('id',$id);
    }
    //
    public function hasUserInRole(int $user_id,$role){
        if (is_string($role)) {
            return $this->users()->wherePivot('role_id',$this->getRole($role)->id)->get()->contains('id',$user_id);
        }elseif(is_int($role)){
            return $this->users()->wherePivot('role_id',$role)->get()->contains('id',$user_id);
        }
    }
    //
    public function getUser(int $id){
        return $this->users()->find($id);
    }
    


    //
    public function inviteUser(int $user_id,$role){
        $user=User::find($user_id);
        $role_id=$this->getRole($role)->id;
        if ($user->hasGroup($this->id)) {
            $this->removeUser($user_id);
        }
        $user->assignRole($role_id);
        return $this->users()->attach($user_id,['role_id'=>$role_id]);
    }
    //
    public function removeUser(int $user_id){
        $user=User::find($user_id);
        $role_id=$user->getRole($this->id)->id;
        $user->removeRole($role_id);
        return $this->users()->detach($user->id);
    }





    //
    public function createRole(string $name,string $password){
        $role=$this->roles()->create([
            'name'=>$this->unique_name.$name,
            'role_name'=>$name,
            'index'=>$this->calcRoleIndex(),
            'password'=>Hash::make($password),
        ]);
        $this->refreshPermissions();
        return $role;
    }
    //
    public function deleteRole($role){
        $role=$this->getRole($role);
        $this->users()->wherePivot('role_id',$role->id)->detach();
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();
        return $this->refreshRoles();
    }
    public function deleteRoleByIndex(int $index){
        $role_id=$this->getRoleByIndex($index)->id;
        return $this->deleteRole($role_id);
    }
    //
    public function roles(){
        return $this->morphMany(config('kaigohack.role.namespace'),'model');
    }
    //
    public function getRole($role){
        if (is_string($role)) {
            return $this->roles()->where('role_name',$role)->first();
        }elseif(is_int($role)){
            return $this->roles()->find($role);
        }
    }
    //
    public function getRoleByIndex(int $index){
        return $this->roles()->where('index',$index)->first();
    }
    
    //
    public function usersHaveRole($role){
        $role=$this->getRole($role);
        return $this->users()->wherePivot('role_id',$role->id);
    }
    //
    private function calcRoleIndex(){
        $index=$this->roles()->pluck('index');
        for($i=0;$i<100;$i++){
            $diff=collect(range(50*$i, 50*($i+1)))->diff($index);
            if($diff->isNotEmpty()){
                return $diff->min();
            }
        }
    }






    //
    public function type(){
        return $this->belongsTo('App\Models\Group\GroupType','group_type_id');
    }
    //
    public function getType(){
        return $this->type()->first();
    }
    //
    public function getTypeName(){
        return $this->getType()->name;
    }
    //
    public function getFormattedTypeName(){
        return $this->getType()->formatted_name;
    }


    //
    public function getUserInfoBases(int $user_id){
        return $this->getUser($user_id)->infoBases()->whereIn('info_template_id',$this->getType()->user_info)->get();
    }
    //
    public function getUserInfoBase(int $user_id,int $template_id){
        if(collect($this->getType()->user_info)->contain($template_id)){
            return $this->getUser($user_id)->getInfoBaseByTemplate($template_id);
        }
    }
    //
    public function getAvailableInfoBases(){
        return $this->infoBases()->where('available',true)->get();
    }
    //
    public function getAvailableInfoBasesByRole($role){
        $role=$this->getRole($role);
        $bases=$this->infoBases()->get();
        $return=[];
        foreach ($bases as $base){
            if($base->available||$role->hasPermissionTo('group_info.'.$base->index.'.view')){
                $return[]=$base;
            }
        }
        return $return;
    }


    //
    public function uploadImg(UploadedFile $img){
        return $this->trait_uploadImg($img,$this->unique_name);
    }
    





    //
    public function location(){
        return $this->hasOne('App\Models\Group\GroupLocation', 'id');
    }
    //
    public function setLocation(float $latitude,float $longitude){
        return $this->location()->fill([
            'latitude'=>$latitude,
            'longitude'=>$longitude,
        ])->save();
    }



    //
    public function usersRequestJoin(){
        return $this->belongsToMany(
            config('auth.providers.users.model'),'group_join_requests','group_id','user_id'
        )->withPivot('role_id')->withTimestamps();
    }
    public function hasUserJoinRequest(int $user_id){
        return $this->usersRequestJoin()->wherePivot('user_id',$user_id)->get()->isNotEmpty();
    }
    //
    public function requestJoin(int $user_id,$role){
        if($this->hasUserInRole($user_id,config('kaigohack.creator'))){
            return false;
        }
        if($this->hasUserJoinRequest($user_id)){
            $this->usersRequestJoin()->detach($user_id);
        }
        $role=$this->getRole($role);
        return $this->usersRequestJoin()->attach($user_id,['role_id'=>$role->id]);
    }
    //
    public function quitRequestJoin(int $user_id){
        return $this->usersRequestJoin()->detach($user_id);
    }





    //
    public function extraUsers(string $name=null){
        if($name == null){
            return $this->belongsToMany(
                config('auth.providers.users.model'),'extra_group_users','group_id','user_id'
            )->withPivot('name')->withTimestamps();
        }else{
            return $this->belongsToMany(
                config('auth.providers.users.model'),'extra_group_users','group_id','user_id'
            )->withPivot('name')->withTimestamps()->wherePivot('name',$name);
        }
    }
    //
    public function countExtraUsers(string $name){
        return $this->extraUsers()->wherePivot('name',$name)->get()->count();
    }


    



   
    

    
}
