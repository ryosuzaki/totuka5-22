<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupLocation extends Model
{
    //
    /**
     * 座標取得
     *
     * @return array
     */
    public function getLocationAttribute()
    {
        return [
                'longitude'=>$this->longitude,
                'latitude'=>$this->latitude,
        ];
    }
}
