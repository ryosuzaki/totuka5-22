<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

use Illuminate\Support\Facades\Auth;

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
    public function mapShelterAndDangerSpot(){
        $tmp_shelters=GroupType::findByIdOrName("shelter")->groups()->get();
        $tmp_danger_spots=GroupType::findByIdOrName("danger_spot")->groups()->get();
        $shelter_locations=[];
        $danger_spot_locations=[];
        $shelters=[];
        $danger_spots=[];
        foreach($tmp_shelters as $shelter){
            if($shelter->isLocationSet()){
                $shelters[]=$shelter;
                $shelter_locations[]=$shelter->getLocation()->location;
            }
        }
        foreach($tmp_danger_spots as $danger_spot){
            if($danger_spot->isLocationSet()){
                $danger_spots[]=$danger_spot;
                $danger_spot_locations[]=$danger_spot->getLocation()->location;
            }
        }
        return view('group.components.map.shelter_and_danger_spot_map')->with(["shelters"=>$shelters,"shelter_locations"=>$shelter_locations,"danger_spots"=>$danger_spots,"danger_spot_locations"=>$danger_spot_locations]);
    }
    //
    public function getInfoWindowHtml(Group $group){
        return response()->view('group.components.map.infowindow.'.$group->getTypeName(), ['group'=>$group]);;
    }
}
