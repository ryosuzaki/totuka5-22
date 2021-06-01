<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Group\Group;

use Illuminate\Support\Facades\Hash;
use Validator;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user=User::find($user_id);
        return view('user.group.index')->with([
            'user'=>$user,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$group_id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,$group_id)
    {
        //
        $group=Group::find($group_id);
        $user=User::find($user_id);
        return view('user.group.edit.'.$group->type)->with([
                'group'=>$group,
                'user'=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id,$group_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer|min:1|exists:group_roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        if(!Hash::check($request->password,$group->role($request->role_id)->password)){
            return back()->withInput();
        }
        $group->users()->updateExistingPivot($user_id,[
            'role_id'=>$request->role_id,
        ]);
        return redirect()->route('user.group.index',$user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$group_id)
    {
        //
        $user=User::find($user_id);
        $user->groups()->detach($group_id);
        return redirect()->route('user.group.index',$user_id);
    }
}
