<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;

use Validator;

class UploadFileController extends Controller
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
        $files=$group->data;
        $files['img'][]=$request->file('img')->store('public/'.$group->type);
        $group->data=$files;
        $group->save();
        return redirect()->back();
    }
}
