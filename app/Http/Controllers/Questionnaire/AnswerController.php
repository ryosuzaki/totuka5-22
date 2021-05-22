<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Questionnaire\Answer;
use App\Models\Questionnaire\Question;
use app\User;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id,$question_id)
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int $user_id $question_id
     * @return \Illuminate\Http\Response
     */
    public function create($user_id,$question_id)
    {
        //
        return view('questionnaire.answer.create')->with([
            'user'=>User::find($user_id),
            'question'=>Question::find($question_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $user_id,$question_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id,$question_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $user=User::find($user_id);
        $user->questions()->attach($question_id,[
            'answer'=>$request->toArray()['answer'],
        ]);
        return redirect()->route('user.questionnaire',$user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id,$question_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$question_id)
    {
        //
        $user=User::find($user_id);
        return view('questionnaire.answer.show')->with([
            'answer'=>$user->questions()->where('question_id',$question_id)->get(),
            'user'=>$user,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id,$question_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,$question_id)
    {
        //
        $user=User::find($user_id);
        return view('questionnaire.answer.edit')->with([
            'answer'=>$user->questions()->where('question_id',$question_id)->get(),
            'user'=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id,$question_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id,$question_id)
    {
        //validation
        $validator = Validator::make($request->all(),[

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $user=User::find($user_id);
        $user->questions()->updateExistingPivot($question_id,[
            'answer'=>$request->toArray()['answer'],
        ]);
        return redirect()->route('user.questionnaire',$user_id);
    }
}
