<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfoBase extends Model
{
    //
    protected $guarded=[];
    //
    public function users()
    {
        return $this->belongsToMany(
            'App\User','user_infos','base_id','user_id'
        )->withPivot('updated_by','info')->using('App\UserInfo');
    }
}
