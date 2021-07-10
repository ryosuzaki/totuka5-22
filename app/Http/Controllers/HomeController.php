<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group\GroupType;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('home.home');
    }
    //
    public function groupType(GroupType $type){
        return view('home.group_type.'.$type->name)->with(['type'=>$type]);
    }
}
