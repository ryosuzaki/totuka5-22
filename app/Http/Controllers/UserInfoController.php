<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Info\InfoBase;

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
        InfoBase::find($base_id)->updateInfo($base_id,[
            'info'=>$request->toArray()['info'],
        ]);
        return redirect()->back();
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
