<?php

namespace App\Http\Controllers\User\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notifications\Announcement;

use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    //
    public function index(){
        info(Auth::user()->announcements()->get());
        return view('user.components.announcement.index')->with([
            'user'=>Auth::user(),
            'announcements'=>Auth::user()->announcements()->get(),
        ]);
    }

    //
    public function show(string $id){
        $announcement=Auth::user()->announcements()->find($id);
        $announcement->markAsRead();
        return view('user.components.announcement.show')->with([
            'user'=>Auth::user(),
            'announcement'=>$announcement,
        ]);
    }

    //
    public function markAsReadAll(){
        Auth::user()->unreadAnnouncements()->markAsRead();
        return redirect()->back();
    }

    //
    public function destroy(Announcement $announcement){
        $announcement->delete();
        return redirect()->back();
    }
}
