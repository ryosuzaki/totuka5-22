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
    public function watch(int $group_id){
        Auth::user()->attachExtraGroup($group_id,config('group.watch'));
        return redirect()->back();
    }
    //
    public function unwatch(int $group_id){
        Auth::user()->detachExtraGroup($group_id,config('group.watch'));
        return redirect()->back();
    }
}
