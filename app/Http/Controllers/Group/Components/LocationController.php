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
        $type_groups=$type->groups()->get();
        $locations=[];
        $groups=[];
        $icons=[];
        $labels=[];
        foreach($type_groups as $group){
            if($group->isLocationSet()){
                $groups[]=$group;
                $locations[]=$group->getLocation()->location;

            }
        }
        return view('group.components.map.map')->with(["groups"=>$groups,"locations"=>$locations]);
    }


    //
    public function show(Group $group){
        return view('group.components.location.show')->with(['initial'=>$group->getLocation()->location]);
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
