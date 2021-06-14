<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\Models\Info\InfoBase;

use App\User;

use App\Models\Group\GroupRole;
use App\Models\Group\GroupType;

use App\Traits\InfoFuncs;

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
    //
    protected $guarded = ['id'];
    

    
    //
    public static function setup(User $user,string $name,string $type,string $admin_password){
        $type=GroupType::findByName($type);
        $group=parent::create([
            'group_type_id'=>$type->id,
            'name'=>$name,
        ]);
        $admin=$group->createGroupRole('管理者',$admin_password)->getRole();
        $admin->givePermissionTo('group.*');
        $user->assignRole($admin->id);
        return $group;
    }
    //
    public static function teardown(int $group_id){
        return parent::destroy($group_id);
    }



    //
    public function users(){
        return $this->belongsToMany(
            'App\User','group_role_user','group_id','user_id'
        )->withPivot('role_id')->using('App\Models\Group\GroupUser');
    }
    //
    public function hasUser(int $id){
        return $this->users()->contains('user_id',$id);
    }
    


    //
    public function inviteUser(int $user_id,int $role_id){
        return $this->users()->attach($user_id,['role_id'=>$role_id]);
    }
    //
    public function removeUser(int $user_id){
        return $this->users()->detach($user_id);
    }



    //
    public function createGroupRole(string $name,string $password){
        $role=Role::create([
            'name'=>'group'.$this->id.$name,
        ]);        
        return GroupRole::create([
            'id'=>$role->id,
            'group_id'=>$this->id,
            'name'=>$name,
            'password'=>Hash::make($password),
        ]);
    }
    //
    public function deleteGroupRole(int $role_id){
        return GroupRole::destroy($role_id);
    }
    //
    public function groupRoles(){
        return $this->hasMany('App\Models\Group\GroupRole','group_id');
    }
    //
    public function usersHaveRole(string $role_name){
        $role=Role::findByName('group'.$this->id.$role_name);
        return $this->users()->wherePivot('role_id',$role->id);
    }



    //
    public function type(){
        return $this->belongsTo('App\Models\Group\GroupType','group_type_id');
    }
    //
    public function getType(){
        return $this->type();
    }
    //
    public function getTypeName(){
        return $this->type()->first()->name;
    }




    //
    public function createInfoBase(int $template_id){
        $base=$this->trait_createInfoBase($template_id);
        return $base;
    }




    //
    public function uploadImg(UploadedFile $img){
        return Image::upload($img,'group'.$this->id);
    }
    //
    public function images(){
        return $this->morphMany('App\Models\Upload\Image','imageable');
    }





    //
    public function location(){
        return $this->hasOne('App\Models\Group\GroupLocation', 'group_id');
    }
    //
    public function setLocation(float $latitude,float $longitude){
        return $this->location()->fill([
            'latitude'=>$latitude,
            'longitude'=>$longitude,
        ])->save();
    }




    

    
   
    

    
}
