<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Questionnaire\Answer;
use App\Models\Questionnaire\Question;
use App\User;

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
    public function index($user_id)
    {
        $user=User::find($user_id);
        return view('questionnaire.answer.index')->with([
            'user'=>$user,
            'answers'=>$user->answers()->get(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int $user_id $answer_id
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        return view('questionnaire.answer.create')->with([
            'user'=>User::find($user_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $user_id,$answer_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $user=User::find($user_id);
        $user->answers()->create([
            'date'=>now()->format('Y-m-d'),
            'answer'=>$request->toArray()['answer'],
        ]);
        return redirect()->route('user.question.answer.index',$user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id,$answer_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$answer_id)
    {
        //
        return view('questionnaire.answer.show')->with([
            'answer'=>Answer::find($answer_id),
            'user'=>User::find($user_id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id,$answer_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,$answer_id)
    {
        return view('questionnaire.answer.edit')->with([
            'answer'=>Answer::find($answer_id),
            'user'=>User::find($user_id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id,$answer_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id,$answer_id)
    {
        //validation
        $validator = Validator::make($request->all(),[

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $user=User::find($user_id);
        Answer::find($answer_id)->fill([
            'answer'=>$request->toArray()['answer'],
            ])->save();
        return redirect()->route('user.answer.index',$user_id);
    }
}
