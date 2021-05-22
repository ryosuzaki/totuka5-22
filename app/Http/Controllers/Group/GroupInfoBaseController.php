<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\GroupInfoBase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class GroupInfoBaseController extends Controller
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
        return view('group.info_base.index')->with(['bases'=>GroupInfoBase::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('group.info_base.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $base=GroupInfoBase::create([
            'name'=>$request['name'],
        ]);
        return redirect()->route('group.info_base.edit',$base->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($base_id)
    {
        //
        return view('group.info_base.edit')->with(['base'=>GroupInfoBase::find($base_id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group_id,$base_id)
    {
        //
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $base=GroupInfoBase::find($base_id)->fill([
            'name'=>$request['name'],
        ])->save();
        return redirect()->route('group.info_base.edit',$base_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($base_id)
    {
        //
        $base=GroupInfoBase::find($base_id);
        $base->infos()->delete();
        $base->delete();
        return redirect()->route('home');
    }

    /**
     * 
     *
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function attach($group_id,$base_id)
    {
        //
        $group=Group::find($group_id);
        $group->infoBases()->attach($base_id,[
            'updated_by'=>Auth::id(),
        ]);
        return redirect()->route('group.info_base.info.edit',[$group_id,$base_id]);
    }

    /**
     * 
     *
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function detach($group_id,$base_id)
    {
        //
        $group=Group::find($group_id);
        $group->infoBases()->detach($base_id);
        return redirect()->route('group.show',$group_id);
    }
}
