<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
        $user=User::find($user_id);
        return view('user.group.index')->with([
            'user'=>$user,
            'groups'=>$user->groups()->get(),
            'group_roles'=>$user->groupRoles()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $user_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$group_id)
    {
        //
        $user=User::find($user_id);
        return view('user.group.index')->with([
            'user'=>$user,
            'groups'=>$user->groups()->where('group_id',$group_id)->first(),
            'group_roles'=>$user->groupRoles()->where('group_id',$group_id)->first(),
        ]);
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
        //
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
        $user->groupRoles()->detach($group_id);
        return redirect()->route('user.group.index',$user_id);
    }
}
