<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;

use App\Models\Questionnaire\Question;
use App\User;

class Answer extends Model
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'answer'  => 'json',
    ];
    //
    protected $dates = ['date'];
    //
    public function user(){
        return $this->belongsTo('App\User');
    }
}
