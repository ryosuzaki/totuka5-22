<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        )->using('App\Models\Group\GroupUser');
    }
    //
    public function groupRoles(){
        return $this->belongsToMany(
            'App\Models\Group\GroupRole','group_users','user_id','role_id'
        )->using('App\Models\Group\GroupUser');
    }
    //
    public function questions(){
        return $this->belongsToMany(
            'App\Models\Questionnaire\Question','answers','user_id','question_id'
        )->withPivot('answer')->using('App\Models\Questionnaire\Answer');
    }
    //
    public function infoBases(){
        return $this->belongsToMany(
            'App\UserInfoBase','user_infos','user_id','base_id'
        )->withPivot('updated_by','info')->using('App\UserInfo');
    }
}
