<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupInfoBase;
use App\Models\Group\GroupInfo;

use Illuminate\Support\Facades\Auth;
use Validator;

class GroupInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function edit($group_id,$base_id)
    {
        //
        $group=Group::find($group_id);
        return view('group.info.edit')->with([
            'group'=>$group,
            'info'=>$group->infoBases()->where('base_id',$base_id)->first(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$group_id,$base_id)
    {
        //validation
        $validator = Validator::make($request->all(),[

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $group->infoBases()->updateExistingPivot($base_id,[
            'updated_by'=>Auth::id(),
            'info'=>$request->toArray()['info'],
        ]);
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id,$base_id)
    {
        //
        $group=Group::find($group_id);
        $group->infoBases()->detach($base_id);
        return redirect()->route('home');
    }
}
