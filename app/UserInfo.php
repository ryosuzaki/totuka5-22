<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserInfo extends Pivot
{
    //
    protected $guarded=[];
    //
    protected $casts = [
        'info'  => 'json',
    ];
}
