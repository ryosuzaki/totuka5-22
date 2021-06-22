<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\Models\Info\InfoBase;

use App\User;

use App\Models\Group\GroupRole;
use App\Models\Group\GroupType;

use App\Traits\InfoFuncs;
use App\Traits\UploadImg;

use App\Models\Upload\Image;
use Illuminate\Http\UploadedFile;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Group extends Model
{
    use InfoFuncs{
        InfoFuncs::createInfoBase as trait_createInfoBase;
    }
    use UploadImg{
        uploadImg::uploadImg as trait_uploadImg;
    }
    //
    protected $guarded = ['id'];
    //
    public $creator='作成者';

    
    //
    public static function setUp(int $user_id,string $name,string $type,string $admin_password){
        $type=GroupType::findByName($type);
        $group=parent::create([
            'group_type_id'=>$type->id,
            'name'=>$name,
        ]);
        $admin=$group->createGroupRole($group->creator,$admin_password)->getRole();
        $admin->givePermissionTo('group.*');
        $admin->givePermissionTo('group_info_bases.*');
        $admin->givePermissionTo('group_info_base.*');
        $admin->givePermissionTo('group_roles.*');
        $admin->givePermissionTo('group_role.*');
        $admin->revokePermissionTo('group_role.0.*');
        $group->inviteUser($user_id,$group->creator);
        return $group;
    }
    //
    public static function tearDown(int $group_id){
        return parent::destroy($group_id);
    }



    //
    public function users(){
        return $this->belongsToMany(
            'App\User','group_role_user','group_id','user_id'
        )->withPivot('role_id')->withTimestamps();
    }
    //
    public function hasUser(int $id){
        return $this->users()->get()->contains('id',$id);
    }
    //
    public function getUser(int $id){
        return $this->users()->find($id);
    }
    


    //
    public function inviteUser(int $user_id,$role){
        $user=User::find($user_id);
        if(is_string($role)){
            $role_id=$this->getGroupRole($role)->id;
        }elseif(is_int($role)){
            $role_id=$role;
        }
        if ($user->hasGroup($this->id)) {
            $this->removeUser($user_id);
        }
        $user->assignRole($role_id);
        return $this->users()->attach($user_id,['role_id'=>$role_id]);
    }
    //
    public function removeUser(int $user_id){
        $user=User::find($user_id);
        $role_id=$user->getGroupRole($this->id)->id;
        $user->removeRole($role_id);
        return $this->users()->detach($user_id);
    }





    //
    public function createGroupRole(string $name,string $password){
        $role=Role::create([
            'name'=>'group'.$this->id.$name,
        ]);        
        return GroupRole::create([
            'id'=>$role->id,
            'index'=>$this->groupRoles()->count(),
            'group_id'=>$this->id,
            'name'=>$name,
            'password'=>Hash::make($password),
        ]);
    }
    //
    public function deleteGroupRole(int $role_id){
        Role::destroy($role_id);
        $this->users()->wherePivot('role_id',$role_id)->detach();
        return GroupRole::destroy($role_id);
    }
    //
    public function groupRoles(){
        return $this->hasMany('App\Models\Group\GroupRole','group_id');
    }
    //
    public function getGroupRole($role){
        if (is_string($role)) {
            return $this->groupRoles()->where('name',$role)->first();
        }elseif(is_int($role)){
            return $this->groupRoles()->find($role);
        }
    }
    //
    public function UsersHaveRole($role){
        $role_id=$this->getGroupRole($role)->id;
        return $this->users()->wherePivot('role_id',$role_id)->get();
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
    public function createInfoBase(int $template_id){
        $base=$this->trait_createInfoBase($template_id);
        return $base;
    }




    //
    public function uploadImg(UploadedFile $img){
        return $this->trait_uploadImg($img,'group'.$this->id);
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
            'App\User','group_join_requests','group_id','user_id'
        )->withPivot('role_id')->withTimestamps();
    }
    //
    public function requestJoin(int $user_id,$role){
        $role_id=$this->getGroupRole($role)->id;
        return $this->usersRequestJoin()->attach($user_id,['role_id',$role_id]);
    }





    //
    public function extraUsers(){
        return $this->belongsToMany(
            'App\Models\Group\Group','extra_group_users','group_id','user_id'
        )->withPivot('name')->withTimestamps();
    }
    //
    public function countExtraUsers(string $name){
        return $this->extraUsers()->wherePivot('name',$name)->get()->count();
    }


    

    
   
    

    
}
