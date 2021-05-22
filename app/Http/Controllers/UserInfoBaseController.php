<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfoBase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;


class UserInfoBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.info_base.index')->with(['bases'=>UserInfoBase::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.info_base.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $base=UserInfoBase::create([
            'name'=>$request['name'],
        ]);
        return redirect()->route('user.info_base.edit',$base->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('user.info_base.show')->with(['base'=>UserInfoBase::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('user.info_base.edit')->with(['base'=>UserInfoBase::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $base=UserInfoBase::find($id)->fill([
            'name'=>$request['name'],
        ])->save();
        return redirect()->route('user.info_base.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $base=UserInfoBase::find($id);
        $base->users()->detach($id);
        $base->delete();
        return redirect()->route('home');
    }

    /**
     * 
     *
     * @param  int  $user_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function attach($user_id,$base_id)
    {
        //
        $user=User::find($user_id);
        $user->infoBases()->attach($base_id,[
            'updated_by'=>Auth::id(),
        ]);
        return redirect()->route('user.info_base.info.edit',[$user_id,$base_id]);
    }

    /**
     * 
     *
     * @param  int  $user_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function detach($user_id,$base_id)
    {
        //
        $user=User::find($user_id);
        $user->infoBases()->detach($base_id);
        return redirect()->route('user.show',$user_id);
    }

}
