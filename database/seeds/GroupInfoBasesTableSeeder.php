<?php

use Illuminate\Database\Seeder;

use App\Models\Group\GroupInfoBase;

class GroupInfoBasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GroupInfoBase::create([
            'id' => 1,
            'name' => '基本情報',
            'icon'=>'<span class="material-icons">info</span>',
            'default_info'=>['info'=>''],
        ]);

        GroupInfoBase::create([
            'id' => 2,
            'name' => '混雑状況',
            'icon'=>'<span class="material-icons">groups</span>',
            'default_info'=>['degree'=>'0%','info'=>''],
        ]);
    }
}
