<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoTemplate;

use App\Models\Group\Group;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        InfoTemplate::create([
            'id' => 1,
            'name' => '基本情報',
            'default'=>['body'=>''],
            'model'=>Group::class,
            'detail'=>'基本の情報表示',
        ]);

        InfoTemplate::create([
            'id' => 2,
            'name' => '混雑状況',
            'default'=>['degree'=>'0%','detail'=>''],
            'model'=>Group::class,
            'detail'=>'混雑状況を表示します',
        ]);

        InfoTemplate::create([
            'id' => 3,
            'name' => '地点情報',
            'default'=>['type'=>'','detail'=>''],
            'model'=>Group::class,
            'detail'=>'地点情報を表示します',
        ]);
    }
}
