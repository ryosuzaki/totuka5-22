<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Role;

use Illuminate\Support\Facades\Gate;

use Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function edit(Group $group,int $index)
    {
        Gate::authorize('permission-group-users',[$group,$index]);
        return view('group.permission.edit')->with([
            'group'=>$group,
            'role'=>$group->getRoleByIndex($index),
            ]);
    }

    //
    public function update(Request $request,Group $group,int $index)
    {
        Gate::authorize('permission-group-users',[$group,$index]);
        $validator = Validator::make($request->all(),[
            'permissions.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $role=$group->getRoleByIndex($index);
        //
        $role->syncPermissions((array)$request->permissions);
        return redirect()->route('group.role.index',$group->id);
    }
}
