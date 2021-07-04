<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

class MapController extends Controller
{
    //
    public function map(){
        $all=Group::all();
        $groups=[];
        foreach($all as $group){
            $groups[]=$group->location()->get();
        }
        return view('group.map')->with([
            'groups'=>$groups,
        ]);
    }
}
