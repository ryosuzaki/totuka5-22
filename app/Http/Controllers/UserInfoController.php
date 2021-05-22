<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\UserInfoBase;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,$base_id)
    {
        //
        $user=User::find($user_id);
        return view('user.info.edit')->with([
            'user'=>$user,
            'info'=>$user->infoBases()->where('base_id',$base_id)->first()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id,$base_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $user=User::find($user_id);
        $user->infoBases()->updateExistingPivot($base_id,[
            'updated_by'=>Auth::id(),
            'info'=>$request->toArray()['info'],
        ]);
        return redirect()->route('user.show',$user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$base_id)
    {
        //
        $user=User::find($user_id);
        $user->infoBases()->detach($base_id);
        return redirect()->route('home');
    }
}
