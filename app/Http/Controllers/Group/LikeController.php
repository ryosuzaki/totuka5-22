<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public static $name='いいね';
    public function like($group_id){
        Auth::user()->attachExtraGroup($group_id,self::$name);
        return redirect()->back();
    }
    //
    public function unlike($group_id){
        Auth::user()->detachExtraGroup($group_id,self::$name);
        return redirect()->back();
    }
}
