<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Gate;

use Validator;


class GroupController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $type)
    {
        return view('group.create')->with(['type'=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'password'=>'required|alpha_num|min:4|max:255|confirmed'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $type_name=$request->type;
        $group=Group::setUp(Auth::id(),$request->name,$type_name,$request->password);
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group,int $index=0)
    {
        if(Auth::user()->hasGroup($group->id)){
            $bases=$group->getAvailableInfoBasesByRole(Auth::user()->getRoleByGroup($group->id)->id);
        }else{
            $bases=$group->getAvailableInfoBases();
        }
        return view('group.show')->with([
            'group'=>$group,
            'bases'=>$bases,
            'index'=>$index,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        Gate::authorize('update', $group);
        return view('group.edit')->with([
            'group'=>$group,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group)
    {
        Gate::authorize('update', $group);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->fill([
            'name'=>$request->name,
        ])->save();
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        Gate::authorize('delete', $group);
        foreach($group->infoBases()->get() as $base){
            $group->deleteInfoBase($base->id);
        }
        foreach($group->roles()->get() as $role){
            $group->deleteRole($role->id);
        }
        $group->delete();
        return redirect()->route('group.home');
    }
    
}
