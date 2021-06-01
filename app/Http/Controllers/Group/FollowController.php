<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

class FollowController extends Controller
{
    //
    public static $rank=255;
    //
    public function follow($group_id,$user_id){
        $group=Group::find($group_id);
        $user=User::find($user_id);
        $group->attachRole($user,self::$rank);
        return redirect()->back();
    }
    //
    public function unfollow($group_id,$user_id){
        $group=Group::find($group_id);
        $user=User::find($user_id);
        $group->detachRole($user,self::$rank);
        return redirect()->back();
    }
}
