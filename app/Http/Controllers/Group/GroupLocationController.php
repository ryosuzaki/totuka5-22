<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupLocation;

use Illuminate\Support\Facades\Gate;

use Validator;

class GroupLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function edit(Group $group)
    {
        Gate::authorize('update', $group);
        return view('group.location.edit')->with(['group'=>$group]);
    }

    //
    public function update(Request $request,Group $group)
    {
        Gate::authorize('update', $group);
        $validator = Validator::make($request->all(),[
            'location.longitude'=>'required|numeric',
            'location.latitude'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->location()->fill([
            'longitude'=>(float)$request->longitude,
            'latitude'=>(float)$request->latitude,
        ])->save();
        return redirect()->route('group.show',$group->id);
    }
}
