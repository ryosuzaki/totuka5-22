<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupInfoBase extends Model
{
    //
    protected $guarded = [];
    
    //
    public function groups()
    {
        return $this->belongsToMany(
            'App\Models\Group\Group','group_infos','base_id','group_id'
        )->withPivot('updated_by','info')->using('App\Models\Group\GroupInfo');
    }
}
