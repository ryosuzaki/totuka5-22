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
            'use_location'=>true,
            'required_info'=>[1,2,7],
            'user_info'=>[],
            'creator_permissions'=>[
                'group.*',
                'group_info_bases.*',
                'group_info.*',
                'group_roles.*',
                'group_users.*',
            ],
        ]);
        GroupType::create([
            'name'=>'danger_spot',
            'formatted_name'=>'危険地点',
            'use_location'=>true,
            'required_info'=>[3],
            'user_info'=>[],
            'creator_permissions'=>[
                'group.*',
                'group_info.*'
            ],
        ]);
        GroupType::create([
            'name'=>'nursing_home',
            'formatted_name'=>'介護施設',
            'use_location'=>false,
            'required_info'=>[1,11,12],
            'user_info'=>[10,9,8,4,5,6],
            'creator_permissions'=>[
                'group.*',
                'group_info_bases.*',
                'group_info.*',
                'group_roles.*',
                'group_users.*',
            ],
        ]);
          
    }
}
