<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Info\InfoTemplate;

use Illuminate\Support\Facades\Auth;

use Validator;

class UserInfoBaseController extends Controller
{
    //
    public function index()
    {
        return view('user.info_base.index')->with(['user'=>Auth::user(),'bases'=>Auth::user()->infoBases()->get()]);
    }

    //
    public function create()
    {
        return view('user.info_base.create')->with(['user'=>Auth::user(),'templates'=>InfoTemplate::where('model',get_class(Auth::user()))->get()]);
    }

    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'templates.*'=>['required', 'integer','min:1','exists:info_templates,id']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach((array)$request->templates as $template){
            Auth::user()->createInfoBase($template);
        }
        return redirect()->route('user.show');
    }

    //
    public function show($id)
    {
        //
    }

    /*
    //
    public function edit($id)
    {
        return view('user.info_base.edit')->with(['user'=>Auth::user(),'base'=>Auth::user()->getInfoBase($id)]);
    }

    //
    public function update(Request $request,int $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Auth::user()->getInfoBase($id)->fill([
            'name'=>$request->name,
        ])->save();
        return redirect()->route('user.info_base.index',Auth::id());
    }*/

    //
    public function destroy(int $id)
    {
        Auth::user()->deleteInfoBase($id);
        return redirect()->back();
    }
}
