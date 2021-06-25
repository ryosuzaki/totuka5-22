<?php

namespace App\Http\Controllers\Group;

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
    public static $name='いいね';
    //
    public function like(int $group_id){
        Auth::user()->attachExtraGroup($group_id,self::$name);
        return redirect()->back();
    }
    //
    public function unlike(int $group_id){
        Auth::user()->detachExtraGroup($group_id,self::$name);
        return redirect()->back();
    }
}
