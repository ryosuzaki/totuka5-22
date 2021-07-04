<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupLocation;

class GroupLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function edit(Group $group)
    {
        return view('group.location.edit')->with(['group'=>$group]);
    }

    //
    public function update(Request $request,Group $group)
    {
        $validator = Validator::make($request->all(),[
            'location.longitude'=>'required|numeric',
            'location.latitude'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->location()->fill([
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
        ])->save();
        return redirect()->route('group.show',$group->id);
    }
}
