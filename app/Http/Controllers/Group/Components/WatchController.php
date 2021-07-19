<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use Illuminate\Support\Facades\Auth;

class WatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function watch(Group $group){
        Auth::user()->attachExtraGroup($group->id,config('kaigohack.watch'));
        return redirect()->back();
    }
    //
    public function unwatch(Group $group){
        Auth::user()->detachExtraGroup($group->id,config('kaigohack.watch'));
        return redirect()->back();
    }
}
