<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Wildside\Userstamps\Userstamps;

class UserInfo extends Pivot
{
    use Userstamps;
    //
    protected $guarded=[];
    //
    protected $casts = [
        'info'  => 'json',
    ];
}
