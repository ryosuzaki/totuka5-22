<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'question'  => 'json',
    ];
    //
    public function users(){
        return $this->belongsToMany(
            'App\User','answers','question_id','user_id'
        )->withPivot('answer')->using('App\Models\Questionnaire\Answer');
    }
}
