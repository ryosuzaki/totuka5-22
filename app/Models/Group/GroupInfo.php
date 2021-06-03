<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Wildside\Userstamps\Userstamps;

class GroupInfo extends Pivot
{
    use Userstamps;
    //
    protected $guarded = [];
    //
    protected $casts = [
        'info'  => 'json',
    ];
}
