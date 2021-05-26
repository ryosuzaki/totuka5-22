<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupRole;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function index($group_id)
    {
        //
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
    public function create($group_id)
    {
        //
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
    public function store(Request $request,$group_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'rank'=>'required|integer',
            'name'=>'required|max:255',
            'password'=>'required|alpha_num|min:4|max:255|confirmed'//password_confirmation
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $group->roles()->create([
            'rank'=>$request->rank,
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->route('group.role.index',$group_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group,GroupRole $role)
    {
        return view('group.role.show')->with([
            'group'=>$group,
            'role'=>$role,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group,GroupRole $role)
    {
        return view('group.role.edit')->with([
            'group'=>$group,
            'role'=>$role,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $validator = Validator::make($request->all(),[
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=GroupRole::find($id)->fill([
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
        ])->save();
        return redirect()->route('group.role.index',$role->group()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group,GroupRole $role)
    {
        $role->delete();
        return redirect()->back();
    }

    /**
     * Set permissions for this role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setPermissions(Request $request, $id){
        
    }
}
