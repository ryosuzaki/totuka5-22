<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    //
    protected $guarded=[];
    //
    protected $casts = [
        'data'  => 'json',
    ];
    //
    public function roles(){
        return $this->hasMany('App\Models\Group\GroupRole','role_id');
    }
}
