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
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        return view('group.user.index.'.$group->getTypeName())->with([
            'group'=>$group,
            'roles'=>$group->roles()->get(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        return view('group.user.create.'.$group->getTypeName())->with([
            'group'=>$group,
            'roles'=>$group->roles()->get(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group)
    {
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|integer|min:1|exists:users,id',
            'role_id'=>'required|integer|min:1|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        if($group->hasUser((int)$request->user_id)){
            return redirect()->back();
        }
        $group->requestJoin((int)$request->user_id,(int)$request->role_id);
        return redirect()->route('group.user.index',$group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group,$user_id)
    {
        return view('group.user.show.'.$group->getTypeName())->with([
            'group'=>$group,
            'user'=>$group->getUser($user_id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group,$user_id)
    {
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
     * @param Group $group
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group,$user_id)
    {
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer|min:1|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        if(!$group->hasUser($user_id)){
            return redirect()->back();
        }
        $group->requestJoin($user_id,(int)$request->role_id);
        return redirect()->route('group.user.index',$group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group,$user_id)
    {
        $group->removeUser($user_id);
        return redirect()->route('group.user.index',$group->id);
    }
}
