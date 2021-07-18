<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoTemplate;

use App\Models\Group\Group;
use App\User;

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

        InfoTemplate::create([
            'id' => 4,
            'name' => 'ユーザー情報',
            'default'=>['detail'=>''],
            'model'=>User::class,
            'detail'=>'ユーザー情報',
        ]);

        InfoTemplate::create([
            'id' => 5,
            'name' => '健康確認',
            'default'=>['main'=>'回答なし','additional'=>[]],
            'model'=>User::class,
            'detail'=>'健康確認',
            'edit'=>['name'=>'回答','icon'=>'<i class="material-icons">question_answer</i>'],
        ]);

        InfoTemplate::create([
            'id' => 6,
            'name' => '避難/救助状況',
            'default'=>['rescue'=>config('kaigohack.rescue.unrescue'),'group'=>null,'rescuer'=>null,'info'=>[]],
            'model'=>User::class,
            'detail'=>'救助状況',
        ]);

        InfoTemplate::create([
            'id' => 7,
            'name' => 'お知らせ',
            'default'=>[],
            'model'=>Group::class,
            'detail'=>'お知らせ',
            'edit'=>['name'=>'送信','icon'=>'<i class="material-icons">mail_outline</i>'],
        ]);

        InfoTemplate::create([
            'id' => 8,
            'name' => '家族情報',
            'default'=>[],
            'model'=>User::class,
            'detail'=>'家族情報',
        ]);
    }
}
