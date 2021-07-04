<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
    public function index(Group $group,int $index=0)
    {
        Gate::authorize('viewUsers-group-role',[$group,$index]);
        return view('group.user.index')->with([
            'group'=>$group,
            'role'=>$group->getRoleByIndex($index),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group,int $index=0)
    {
        Gate::authorize('inviteUser-group-role',[$group,$index]);
        return view('group.user.create')->with([
            'group'=>$group,
            'role'=>$group->getRoleByIndex($index),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group,int $index)
    {
        Gate::authorize('inviteUser-group-role',[$group,$index]);
        $validator = Validator::make($request->all(),[
            'email'=>'required|string|email|max:255|exists:users,email',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->getRoleByIndex($index);
        $user=User::findByEmail($request->email);
        $group->requestJoin($user->id,$role->id);
        return redirect()->route('group.user.index',[$group->id,$index]);
    }

    //
    public function show(Group $group,int $user_id,int $index)
    {
        Gate::authorize('viewUsers-group-role',[$group,$index]);
        return view('group.user.show')->with([
            'group'=>$group,
            'user'=>$group->getUser($user_id),
            'bases'=>$group->getUserInfoBases($user_id),
            ]);
    }

    /*
    public function edit(Group $group,int $user_id,int $index)
    {
        return view('group.user.edit')->with([
                'group'=>$group,
                'user'=>$group->getUser($user_id),
                'roles'=>$group->roles()->get(),
            ]);
    }

    //
    public function update(Request $request,Group $group,int $user_id,int $index)
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
    }*/

    //
    public function destroy(Group $group,int $user_id,int $index)
    {
        Gate::authorize('removeUser-group-role',[$group,$index]);
        $group->removeUser($user_id);
        return redirect()->route('group.user.index',$group->id);
    }
}
