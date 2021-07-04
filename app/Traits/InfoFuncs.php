<?php

namespace App\Traits;

use App\Models\Info\InfoTemplate;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

trait InfoFuncs
{
    //
    public function createInfoBase(int $template_id){
        $template=InfoTemplate::find($template_id);
        $base=$this->infoBases()->create([
            'index'=>$this->calcInfoBaseIndex(),
            'info_template_id'=>$template->id,
            'name'=>$template->name,
        ]);
        $base->infos()->create([
            'info'=>$template->default,
        ]);
        return $base;
    }
    //
    private function calcInfoBaseIndex(){
        $index=$this->infoBases()->pluck('index');
        for($i=0;$i<100;$i++){
            $diff=collect(range(50*$i, 50*($i+1)))->diff($index);
            if($diff->isNotEmpty()){
                return $diff->min();
            }
        }
    }
    //
    public function deleteInfoBase(int $base_id){
        $base=$this->infoBases()->find($base_id);
        $base->infos()->delete();
        return $base->delete();
    }
    //
    public function infoBases(){
        return $this->morphMany('App\Models\Info\InfoBase','model');
    }
    //
    public function getInfoBase(int $id){
        return $this->infoBases()->get()->find($id);
    }
    //
    public function getInfoBaseByTemplate(int $template_id){
        return $this->infoBases()->where('info_template_id',$template_id)->get();
    }
    //
    public function getInfoBaseByIndex(int $index){
        return $this->infoBases()->where('index',$index)->first();
    }
    //
    public function hasInfoBase(int $template_id){
        return $this->infoBases()->get()->contains('info_template_id',$template_id);
    }


    //
    public function updateInfo(int $base_id,array $info){
        return $this->infoBases()->find($base_id)->updateInfo($info);
    }
    //
    public function infos(){
        $infos=[];
        foreach($this->infoBases()->get() as $base){
            $infos[]=$base->info();
        }
        return collect($infos);
    }
    //
    public function info(int $id){
        return $this->getInfoBase($id)->info();
    }
    //
    public function getInfoByTemplate(int $template_id){
        $infos=[];
        foreach($this->getInfoBaseByTemplate($template_id) as $base){
            $infos[]=$base->info();
        }
        return collect($infos);
    }
    //
    public function infoLogs(int $base_id){
        return $this->infoBases()::find($base_id)->infos()->get();
    }
    //
    public function infoAndBasePairs(){
        return [
            'bases'=>$this->infoBases()->get(),
            'infos'=>$this->infos()->get(),
        ];
    }
    //
    public function infoAndBasePair(int $id){
        $base=$this->getInfoBase($id);
        return [
            'base'=>$base,
            'info'=>$base->info(),
        ];
    }
}