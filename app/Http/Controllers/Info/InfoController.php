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
     * @param int $base_id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $base_id)
    {
        $base=InfoBase::find($base_id);
        return view('info.info.edit')->with([
            'base'=>$base,
            'info'=>$base->info(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $base_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $base_id)
    {
        $validator = Validator::make($request->all(),[
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $base=InfoBase::find($base_id);
        $model=$base->model()->first();
        $base->updateInfo($request->toArray()['info']);
        info($request->toArray()['info']);
        if ($model instanceof User) {
            return redirect()->route('user.show');
        }elseif ($model instanceof Group) {
            return redirect()->route('group.show',$model->id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $base_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $base_id)
    {
        
    }
}
