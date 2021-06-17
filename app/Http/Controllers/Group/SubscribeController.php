<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;

use App\Models\Group\Group;
use App\Models\Group\GroupRole;

use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    //
    public function subscribe($group_id){
        $group=Group::find($group_id);
        $role_id=$group->getGroupRoleByName('登録者')->id;
        $group->inviteUser(Auth::id(),$role_id);
        return redirect()->back();
    }
    //
    public function unsubscribe($group_id){
        $group=Group::find($group_id);
        $group->detachRole($user,self::$rank);
        return redirect()->back();
    }
}
