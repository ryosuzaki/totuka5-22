<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoBase;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GroupType::create([
            'name'=>'shelter',
            'formatted_name'=>'避難所',
            'need_location'=>true,
            'required_info'=>[1,2],
            'available_info'=>[],
        ]);
        GroupType::create([
            'name'=>'danger_spot',
            'formatted_name'=>'危険地点',
            'need_location'=>true,
            'required_info'=>[3],
            'available_info'=>[],
        ]);
        GroupType::create([
            'name'=>'nursing_home',
            'formatted_name'=>'介護施設',
            'need_location'=>false,
            'required_info'=>[1],
            'available_info'=>[],
        ]);
          
    }
}
