<?php

namespace App\Http\Controllers\Group;

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
    public static $name='ウォッチャー';
    //
    public function watch(int $group_id){
        Auth::user()->attachExtraGroup($group_id,self::$name);
        return redirect()->back();
    }
    //
    public function unwatch(int $group_id){
        Auth::user()->detachExtraGroup($group_id,self::$name);
        return redirect()->back();
    }
}
