<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use App\Models\Components\Location;

use Illuminate\Support\Facades\Gate;

use Validator;

class LocationController extends Controller
{
    //
    public function index($type){
        $type=GroupType::findByIdOrName($type);
        $groups=$type->groups()->get();
        $locations=[];
        foreach($groups as $group){
            $locations[]=$group->location()->first()->location;
        }
        return view('components.map')->with(["mame"=>$groups->pluck('name'),"location"=>$locations]);
    }

    //
    public function show(Group $group){
        return view('components.map')->with(['initial'=>$group->location()->first()->location]);
    }

    //
    public function setHere(Request $request,Group $group){
        Gate::authorize('update', $group);
        $validator = Validator::make($request->all(),[
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group->setLocation((float)$request->latitude,(float)$request->longitude);
        return redirect()->back();
    }
}
