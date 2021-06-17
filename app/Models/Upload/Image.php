<?php

namespace App\Models\Upload;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Wildside\Userstamps\Userstamps;

class Image extends Model
{
    use Userstamps;
    //
    protected $guarded=['id'];



    //
    public function infoBaseable(){
        return $this->morphTo();
    }




    //
    public static function upload(UploadedFile $img,string $dir){
        return parent::create([
            'path'=>$img->store('public/'.$dir),
        ]);
    }




    //
    public function getUrl(){
        return Storage::url($this->path);
    }
    //
    public function delete(){
        Storage::delete($this->path);
        parent::destroy($this->id);
        return true;
    }
}
