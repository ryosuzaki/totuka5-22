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
    public string $creator='作成者';
    //$unique_name{{$this->id}}
    public string $unique_name='group';
    //$upload_path{{$this->id}}
    public string $upload_path='group';

    
    //
    public static function setUp(int $user_id,string $name,string $type,string $creator_password){
        $type=GroupType::findByName($type);
        $group=parent::create([
            'group_type_id'=>$type->id,
            'name'=>$name,
        ]);
        //
        $group->unique_name=$group->unique_name.$group->id;
        //
        $group->upload_path=$group->upload_path.$group->id;
        //
        $creator=$group->createRole($group->creator,$creator_password);
        //
        foreach($type->creator_permissions as $permission){
            $creator->givePermissionTo($permission);
        }
        //
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
        return $this->roles()->create([
            'name'=>$this->unique_name.$name,
            'role_name'=>$name,
            'index'=>$this->calcRoleIndex(),
            'password'=>Hash::make($password),
        ]);
    }
    //
    public function deleteRole($role){
        $role=$this->getRole($role);
        $this->users()->wherePivot('role_id',$role->id)->detach();
        $role->permissions()->detach();
        $role->users()->detach();
        return $role->delete();
    }
    //
    public function roles(){
        return $this->morphMany('App\Models\Role','model');
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
    public function createInfoBase(int $template_id){
        $base=$this->trait_createInfoBase($template_id);
        return $base;
    }




    //
    public function uploadImg(UploadedFile $img){
        return $this->trait_uploadImg($img,$this->upload_path);
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
        if($this->hasUserInRole($user_id,$this->creator)){
            return false;
        }
        if($this->hasUser($user_id)){
            $this->removeUser($user_id);
        }
        $role=$this->getRole($role);
        return $this->usersRequestJoin()->attach($user_id,['role_id'=>$role->id]);
    }





    //
    public function extraUsers(){
        return $this->belongsToMany(
            'App\User','extra_group_users','group_id','user_id'
        )->withPivot('name')->withTimestamps();
    }
    //
    public function countExtraUsers(string $name){
        return $this->extraUsers()->wherePivot('name',$name)->get()->count();
    }


    

    
   
    

    
}
