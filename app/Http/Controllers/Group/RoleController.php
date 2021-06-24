<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;
use Validator;

class RoleController extends Controller
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
            'roles'=>$group->roles()->get(),
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
            'roles'=>$group->roles()->get(),
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
        $role=$group->createRole($request->name,$request->password);
        //
        foreach($request->permissions as $permisson){
            if(!$role->hasPermissionTo($permisson)){
                $role->givePermissionTo($permisson);
            }
        }
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
        return view('group.role.show')->with([
            'group'=>$group,
            'role'=>$group->getRole($role_id),
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
            'role'=>$group->getRole($role_id),
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
            'now_password'=>'nullable|alpha_num|min:4|max:255',
            'password'=>'nullable|alpha_num|min:4|max:255|confirmed',
            'permissions.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $role=$group->getRole($role_id);
        //
        if($role->role_name!=$request->name){
            $role->changeName($request->name);
        }
        //
        if($request->password&&$role->checkPassword($request->now_password)){
            $role->changePassword($request->password);
        }
        //
        foreach($role->permissions()->get() as $permisson){
            $role->revokePermissionTo($permisson->id);
        }
        //
        foreach($request->permissions as $permisson){
            if(!$role->hasPermissionTo($permisson)){
                $role->givePermissionTo($permisson);
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
        $group->deleteRole($role_id);
        return redirect()->back();
    }
}
