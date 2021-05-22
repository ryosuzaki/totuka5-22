<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
    public function show($id)
    {
        $user=User::find($id);
        return view('user.show')->with([
            'user'=>$user,
            'infos'=>$user->infoBases()->get()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('user.edit')->with(['user'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user=User::find($id);
        $user->fill([
            'name'=>$request['name'],
            'email'=>$request['email'],
        ])->save();
        return redirect()->route('user.show',$id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::find($id);
        $user->groups()->detach();
        $user->groupRoles()->detach();
        $user->questions()->detach();
        $user->infoBases()->detach();
        $user->delete();
        return redirect()->route('home');
    }

    /**
     * アンケート回答一覧
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answers($id){
        //
        $user=User::find($id);
        return view('user.answers')->with([
            'user'=>$user,
            'answers'=>$user->questions()->get()
            ]);
    }
}
