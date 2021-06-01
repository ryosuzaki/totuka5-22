<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\UserInfoBase;
use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

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
            'App\Models\Group\Group','group_users','user_id','group_id'
        )->withPivot('role_id','data')->using('App\Models\Group\GroupUser');
    }
    //
    public function groupRoles(){
        $roles=[];
        foreach($this->groups()->get() as $group){
            $roles[]=$group->role($group->pivot->role_id);
        }
        return $roles;
    }
    //
    public function group($group_id){
        return $this->groups()->where('id',$group_id)->first();
    }
    //ユーザーがあるグループに持っている役割
    public function groupRole(Group $group){
        return $group->role($this->group($group->id)->pivot->role_id);
    }
    //
    public function groupsHaveType($type){
        return $this->groups()->where('type',$type)->get();
    }
    //
    public function groupTypes(){
        $groups=$this->groups()->get();
        $types=[];
        foreach($groups as $group){
            $types[]=$group->type;
        }
        return array_unique($types);
    }

    //ユーザーがあるグループにあるランクの役割を持っているか Bool
    public function hasGroupRank(Group $group,$rank){
        return $group->users()->where('role_id',$group->rank2role($rank)->id)->get()->contains('id',$this->id);
    }




    //
    public function answers(){
        return $this->hasMany('App\Models\Questionnaire\Answer','user_id');
    }

    //
    public function infoBases(){
        return $this->belongsToMany(
            'App\UserInfoBase','user_infos','user_id','base_id'
        )->withPivot('updated_by','info')->using('App\UserInfo');
    }
    public function infoBase($base_id){
        return $this->infoBases()->where('base_id',$base_id)->first();
    }


    //
    public function attachInfoBase($base_id)
    {
        return $this->infoBases()->attach($base_id,[
            'updated_by'=>Auth::id(),
            'info'=>UserInfoBase::find($base_id)->default_info,
        ]);
        
    }
    //
    public function detachInfoBase($base_id)
    {
        return $this->infoBases()->detach($base_id);
    }

}
