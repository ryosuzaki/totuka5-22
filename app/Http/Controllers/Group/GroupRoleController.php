<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupRole;

use Illuminate\Support\Facades\Auth;
use Validator;

class GroupRoleController extends Controller
{
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
    public function index(int $group_id)
    {
        $group=Group::find($group_id);
        return view('group.role.index')->with([
            'group'=>$group,
            'roles'=>$group->groupRoles()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $group_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $group_id)
    {
        $group=Group::find($group_id);
        return view('group.role.create')->with([
            'group'=>$group,
            'roles'=>$group->groupRoles()->get(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $group_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,int $group_id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'password'=>'required|alpha_num|min:4|max:255|confirmed',
            'permissions.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $group_role=$group->createGroupRole($request->name,$request->password);
        $role=$group_role->getRole();
        //
        foreach($request->permissions as $permisson){
            if(!$role->hasPermissionTo($permisson)){
                $role->givePermissionTo($permisson);
            }
        }
        info($role->permissions()->get());
        return redirect()->route('group.role.index',$group_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $group_id,int $role_id)
    {
        $group=Group::find($group_id);
        info($group->getGroupRole($role_id)->permissions()->get());
        return view('group.role.show')->with([
            'group'=>$group,
            'role'=>$group->getGroupRole($role_id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $group_id,int $role_id)
    {
        $group=Group::find($group_id);
        return view('group.role.edit')->with([
            'group'=>$group,
            'role'=>$group->getGroupRole($role_id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $group_id,int $role_id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'now_password'=>'required|alpha_num|min:4|max:255',
            'password'=>'required|alpha_num|min:4|max:255|confirmed',
            'permissions.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $group_role=$group->getGroupRole($role_id);
        $role=$group_role->getRole();
        //
        if($group_role->name!=$request->name){
            $group_role->changeName($request->name);
        }
        //
        if($request->password!=''&&$group_role->checkPassword($request->now_password)){
            $group_role->changePassword($request->password);
        }
        //
        foreach($request->permissions as $permisson=>$bool){
            if($bool&&!$role->hasPermissionTo($permisson)){
                $role->givePermissionTo($permisson);
            }elseif(!$bool&&$role->hasPermissionTo($permisson)){
                $role->revokePermissionTo($permisson);
            }
        }
        return redirect()->route('group.role.index',$group_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $group_id,int $role_id)
    {
        $group=Group::find($group_id);
        $group->deleteGroupRole($role_id);
        return redirect()->back();
    }
}
