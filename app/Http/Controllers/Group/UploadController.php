<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;



use Validator;

class UploadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //php artisan storage:linkを行う
    public function uploadImg(Request $request,$group_id){
        //validate
        $validator = Validator::make($request->all(),[
            'img'=>'required|mimes:jpg,png|max:10240',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $group=Group::find($group_id);
        $data=$group->data;
        $data['img'][]=$request->file('img')->store('public/'.$group->type);
        $group->data=$data;
        $group->save();
        return redirect()->back();
    }

    public function deleteImg(Request $request,$group_id){
        $validator = Validator::make($request->all(),[
            'img'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group=Group::find($group_id);
        $data=$group->data;
        Storage::delete($data['img'][$request->img]);
        unset($data['img'][$request->img]);
        $data['img'] = array_values($data['img']);
        $group->data=$data;
        $group->save();
        return redirect()->back();
    }
}
