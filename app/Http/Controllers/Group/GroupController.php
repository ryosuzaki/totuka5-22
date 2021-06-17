<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupRole;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class GroupController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $type)
    {
        return view('group.create.'.$type)->with(['type'=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type=$request->type;
        //
        if($type=='shelter'){
            $validator = Validator::make($request->all(),[
                'name'=>'required|max:255',
                'password'=>'required|alpha_num|min:4|max:255|confirmed'//password_confirmation
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            //
            $group=Group::setup(Auth::user(),$request->name,$type,$request->password);
            $group->createGroupRole('ウォッチャー',''); 
            $group->location()->create();
            $group->createInfoBase(1);
            $group->createInfoBase(2);
            return redirect()->route('group.show',$group->id);
        }
        //
        elseif ($type=='danger_spot') {
            $group=Group::setup(Auth::user(),'',$type,Auth::id());
            $group->createGroupRole('いいね',''); 
            $group->location()->create();
            $group->createInfoBase(3);
            return redirect()->route('group.show',$group->id);
        }
        //
        elseif($type=='nursing_home'){
            $validator = Validator::make($request->all(),[
                'name'=>'required|max:255',
                'password'=>'required|alpha_num|min:4|max:255|confirmed'//password_confirmation
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            //
            $group=Group::setup(Auth::user(),$request->name,$type,$request->password);
            $group->location()->create();
            $group->createInfoBase(1);
            return redirect()->route('group.show',$group->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $group_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $group_id,int $index=0)
    {
        $group=Group::find($group_id);
        return view('group.show.'.$group->getTypeName())->with([
            'group'=>$group,
            'bases'=>$group->infoBases()->get(),
            'index'=>$index,
            ]);
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
        return view('group.edit')->with([
            'group'=>Group::find($id),
            ]);
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
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Group::find($id)->fill([
            'name'=>$request->name,
        ])->save();
        return redirect()->route('group.show', $id);
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
        $group=Group::find($id);
        $group->infoBases()->detach();
        $group->users()->detach();
        $group->groupRoles()->delete();
        $group->delete();
        return redirect()->route('group.home');
    }
    

    public function showLoginForm($id){
        $group=Group::find($id);
        return view('group.login')->with([
            'group'=>$group,
            'roles'=>$group->groupRoles()->get(),
        ]);
    }

    public function login(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer',
            'password'=>'required|alpha_num|min:4|max:255'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group=Group::find($id);
        if(!Hash::check($request->password,$group->role($group_id)->password)){
            return back()->withInput();
        }
        $group->users()->attach(Auth::id(),[
            'role_id'=>$request->role_id,
        ]);
        return redirect()->route('user.group.index',[Auth::id(),$id]);
    }
    
}
