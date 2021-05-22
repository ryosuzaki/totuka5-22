<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    //
    protected $guarded=[];
    //
    public function roles(){
        return $this->hasMany('App\Models\Group\GroupRole','role_id');
    }
}
