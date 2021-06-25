<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\InfoBase;
use App\User;
use App\Models\Group\Group;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InfoBase $base
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoBase $base)
    {
        return view('info.info.edit')->with([
            'base'=>$base,
            'info'=>$base->info(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param InfoBase $base
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,InfoBase $base)
    {
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $model=$base->model()->first();
        $base->updateInfo($request->toArray()['info']);
        if ($model instanceof User) {
            return redirect()->route('user.show');
        }elseif ($model instanceof Group) {
            return redirect()->route('group.show',$model->id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InfoBase $base
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoBase $base)
    {
        
    }
}
