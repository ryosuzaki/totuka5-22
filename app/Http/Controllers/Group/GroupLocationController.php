<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupLocation;

class GroupLocationController extends Controller
{
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('group.location.edit')->with(['group'=>Group::find($id)]);
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
        //
        $validator = Validator::make($request->all(),[
            'location.longitude'=>'required|numeric',
            'location.latitude'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group=Group::find($id);
        $group->location()->fill([
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
        ])->save();
        return redirect()->route('group.show',$id);
    }
}
