<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class RescueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function rescue(Group $group,User $user){
        $user->getInfoBaseByTemplate(6)->first()->updateInfo([
            'rescue'=>config('kaigohack.rescue.rescue'),
            'group'=>$group,
            'rescuer'=>Auth::user(),
        ]);
        return redirect()->back();
    }
    //
    public function unrescue(Group $group,User $user){
        $user->getInfoBaseByTemplate(6)->first()->updateInfo([
            'rescue'=>config('kaigohack.rescue.unrescue'),
            'group'=>null,
            'rescuer'=>null,
        ]);
        return redirect()->back();
    }
    //
    public function rescued(Group $group,User $user){
        $user->getInfoBaseByTemplate(6)->first()->updateInfo([
            'rescue'=>config('kaigohack.rescue.rescued'),
            'group'=>$group,
            'rescuer'=>Auth::user(),
        ]);
        return redirect()->back();
    }
}
