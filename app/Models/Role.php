<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

use Illuminate\Support\Facades\Hash;

class Role extends SpatieRole
{
    //
    protected $hidden = [
        'password',
    ];






    //
    public function model(){
        return $this->morphTo();
    }
    


    
    //
    public function changeName($name){
        return $this->fill([
            'name'=>$this->model()->unique_name.$name,
            'role_name'=>$name,
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
