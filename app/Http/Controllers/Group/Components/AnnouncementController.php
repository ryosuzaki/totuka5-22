<?php

namespace App\Http\Controllers\Group\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\User;

use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function send(Request $request,Group $group){
        $group->sendAnnouncement($group->extraUsers(config('kaigohack.watch'))->get(),$request->title,(string)$request->content);
        return redirect()->route('group.show',$group->id);
    }
}
