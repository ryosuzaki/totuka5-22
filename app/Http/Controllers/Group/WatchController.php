<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

class WatchController extends Controller
{
    //
    public function watch($group_id){
        $group=Group::find($group_id);
        $group->inviteUser(Auth::id(),'ウォッチャー');
        return redirect()->back();
    }
    //
    public function unwatch($group_id){
        $group=Group::find($group_id);
        $group->removeUser(Auth::id());
        return redirect()->back();
    }
}
