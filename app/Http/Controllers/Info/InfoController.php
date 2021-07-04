<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\Info;
use App\Models\Info\InfoBase;

use App\User;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InfoBase $info_base
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoBase $info_base)
    {
        return view('info.info.edit')->with([
            'base'=>$info_base,
            'info'=>$info_base->info(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param InfoBase $info_base
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,InfoBase $info_base)
    {
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $model=$info_base->model()->first();
        $info_base->updateInfo($request->toArray()['info']);
        if ($model instanceof User) {
            return redirect()->route('user.show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InfoBase $info_base
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoBase $info_base)
    {
        
    }
}
