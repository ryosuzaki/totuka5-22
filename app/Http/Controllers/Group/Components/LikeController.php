<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function like(int $group_id){
        Auth::user()->attachExtraGroup($group_id,config('kaigohack.like'));
        return redirect()->back();
    }
    //
    public function unlike(int $group_id){
        Auth::user()->detachExtraGroup($group_id,config('kaigohack.like'));
        return redirect()->back();
    }
}
