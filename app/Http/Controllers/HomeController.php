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
    public function groupType($name){
        $type=GroupType::findByName($name);
        return view('home.group_type.'.$type->name)->with(['type'=>$type]);
    }
}
