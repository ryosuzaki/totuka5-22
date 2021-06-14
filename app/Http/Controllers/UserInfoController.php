<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\Models\Info\InfoBase;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $base_id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $base_id)
    {
        $user=Auth::user();
        return view('user.info.edit')->with([
            'user'=>$user,
            'base'=>$user->getInfoBase($base_id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $base_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $base_id)
    {
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $user=Auth::user();
        $user->infoBases()->updateExistingPivot($base_id,[
            'updated_by'=>Auth::id(),
            'info'=>$request->toArray()['info'],
        ]);
        return redirect()->route('user.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $base_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $base_id)
    {
        
    }
}
