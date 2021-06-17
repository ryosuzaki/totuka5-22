<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoTemplate;

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
        ]);

        InfoTemplate::create([
            'id' => 2,
            'name' => '混雑状況',
            'default'=>['degree'=>'0%','detail'=>''],
        ]);

        InfoTemplate::create([
            'id' => 3,
            'name' => '地点情報',
            'default'=>['type'=>'','detail'=>''],
        ]);
    }
}
