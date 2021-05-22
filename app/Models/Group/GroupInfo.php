<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupInfo extends Pivot
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'info'  => 'json',
    ];
}
