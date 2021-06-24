<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use App\User;

use Illuminate\Support\Facades\Auth;
use Validator;

class GroupUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param int $group_id
     * @return \Illuminate\Http\Response
     */
    public function index($group_id)
    {
        $group=Group::find($group_id);
        return view('group.user.index.'.$group->getTypeName())->with([
            'group'=>$group,
            'roles'=>$group->roles()->get(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param int $group_id
     * @return \Illuminate\Http\Response
     */
    public function create($group_id)
    {
        $group=Group::find($group_id);
        return view('group.user.create.'.$group->getTypeName())->with([
            'group'=>$group,
            'roles'=>$group->roles()->get(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $group_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,int $group_id)
    {
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|integer|min:1|exists:users,id',
            'role_id'=>'required|integer|min:1|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        if($group->hasUser((int)$request->user_id)){
            return redirect()->back();
        }
        $group->requestJoin((int)$request->user_id,(int)$request->role_id);
        return redirect()->route('group.user.index',$group_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $group_id,$user_id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id,$user_id)
    {
        $group=Group::find($group_id);
        return view('group.user.show.'.$group->getTypeName())->with([
            'group'=>$group,
            'user'=>$group->getUser($user_id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $group_id,$user_id
     * @return \Illuminate\Http\Response
     */
    public function edit($group_id,$user_id)
    {
        $group=Group::find($group_id);
        return view('group.user.edit.'.$group->getTypeName())->with([
                'group'=>$group,
                'user'=>$group->getUser($user_id),
                'roles'=>$group->roles()->get(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $group_id,$user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$group_id,$user_id)
    {
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer|min:1|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        if(!$group->hasUser($user_id)){
            return redirect()->back();
        }
        $group->requestJoin($user_id,(int)$request->role_id);
        return redirect()->route('group.user.index',$group_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $group_id,$user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id,$user_id)
    {
        $group=Group::find($group_id);
        $group->removeUser($user_id);
        return redirect()->route('group.user.index',$group_id);
    }
}
