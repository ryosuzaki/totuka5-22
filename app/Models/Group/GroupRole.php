<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;

class GroupRole extends Model
{
    //
    protected $guarded=[];
    
    //
    protected $hidden = [
        'password',
    ];

    //
    public $incrementing = false;


    //
    public function group(){
        return $this->belongsTo('App\Models\Group\Group', 'group_id');
    }
    //
    public function permissions(){
        return $this->getRole()->permissions();
    }
    //
    public function users(){
        return $this->belongsToMany(
            'App\User','group_role_user','role_id','user_id'
        )->withPivot('group_id')->withTimestamps();
    }







    //
    public function getRole(){
        return Role::findById($this->id);
    }



    //
    public function changeName($name){
        //管理者は変更不能
        if($this->name==$this->group()->fisrt()->creator){
            return false;
        }
        $this->getRole()->fill([
            'name'=>'group'.$this->group_id.$name,
        ])->save();
        return $this->fill([
            'name'=>$name,
        ])->save();
    }



    //
    public function checkPassword($password){
        return Hash::check($password,$this->password);
    }
    //
    public function changePassword($password){
        return $this->fill([
            'password'=>Hash::make($password),
        ])->save();
    }


    



    
}
