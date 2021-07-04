<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;

use Validator;

class UserGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 参加グループ一覧
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.group.index')->with([
            'user'=>Auth::user(),
            ]);
    }

    /**
     * グループに参加
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * グループに参加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * 役割などを変更
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('user.group.edit')->with([
                'group'=>$group,
                'user'=>Auth::user(),
            ]);
    }

    /**
     * 役割などを変更
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group)
    {
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer|min:1|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        if(!$group->getRole((int)$request->role_id)->checkPassword($request->password)){
            return back()->withInput();
        }
        $group->inviteUser(Auth::id(),(int)$request->role_id);
        return redirect()->route('user.group.index',Auth::id());
    }

    /**
     * 退会
     *
     * @param  int $group_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $group_id)
    {
        Auth::user()->leaveGroup($group_id);
        return redirect()->route('user.group.index');
    }

    //
    public function acceptJoinRequest(int $group_id){
        Auth::user()->acceptJoinRequest($group_id);
        return redirect()->back();
    }
    //
    public function deniedJoinRequest(int $group_id){
        Auth::user()->deniedJoinRequest($group_id);
        return redirect()->back();
    }
}
