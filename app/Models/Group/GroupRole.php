<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;

class GroupRole extends Model
{
    //
    protected $guarded=[
        'id',
        'group_id',
    ];
    
    //
    protected $hidden = [
        'password',
    ];
    //
    public static function create($name,$password){
        $role=Role::create([
            'name'=>'group'.$this->group_id.$name,
        ]);
        return parent::create([
            'id'=>$role->id,
            'group_id'=>$this->group_id,
            'name'=>$name,
            'password'=>Hash::make($password),
        ]);
    }
    //
    public function getRole(){
        return Role::find($this->id);
    }
    //
    public function getRoleName(){
        return 'group'.$this->group_id.$this->name;
    }
    //
    public function getName(){
        return $this->name;
    }
    //
    public function changeName($name){
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


    //
    public function permissions(){
        return $this->getRole()->permissions();
    }
    //
    public function users(){
        return $this->getRole()->users();
    }



    //
    public function group(){
        return $this->belongsTo('App\Models\Group\Group', 'group_id');
    }
}
