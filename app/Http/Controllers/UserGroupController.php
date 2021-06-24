<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function edit($group_id)
    {
        $group=Group::find($group_id);
        $user=User::find($user_id);
        return view('user.group.edit.'.$group->type)->with([
                'group'=>$group,
                'user'=>$user,
            ]);
    }

    /**
     * 役割などを変更
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$group_id)
    {
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer|min:1|exists:roles,id',
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
     * 退会
     *
     * @param  int  $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id)
    {
        //
        $user=User::find($user_id);
        $user->groups()->detach($group_id);
        return redirect()->route('user.group.index',$user_id);
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
