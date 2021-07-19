<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Group\GroupType;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;


class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user=Auth::user();
        return view('user.show')->with([
            'user'=>$user,
            'bases'=>$user->infoBases()->get(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.edit')->with(['user'=>Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user=Auth::user();
        $user->fill([
            'name'=>$request['name'],
            'email'=>$request['email'],
        ])->save();
        return redirect()->route('user.show');
    }

    //
    public function initialSettingForm(){
        return view('user.initial_setting')->with(['types'=>GroupType::all()]);
    }
    //
    public function initialSetting(Request $request){
        $validator = Validator::make($request->all(),[
            'types.*' => ['required', 'integer','min:1','exists:group_types,id'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach ((array)$request->types as $type){
            Auth::user()->useGroupType((int)$type);
        }
        return redirect()->route('user.show');
    }

}
