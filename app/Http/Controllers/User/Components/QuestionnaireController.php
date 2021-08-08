<?php

namespace App\Http\Controllers\User\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Info\InfoBase;

class QuestionnaireController extends Controller
{
    public function update(Request $request,InfoBase $info_base){
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $info_base->updateInfoEmptyFillDefault($request->toArray()['info']); 
        return redirect()->route('user.show');
    }
}
