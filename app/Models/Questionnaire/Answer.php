<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Answer extends Pivot
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'answer'  => 'json',
    ];
}
