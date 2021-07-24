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
            'name' => '基本情報',
            'default'=>['you1'=>'a','you2'=>'','you3'=>'','you4'=>'','you5'=>'','you6'=>'','you7'=>'','you8'=>'','you9'=>'','you10'=>'OFF','home1'=>'','home2'=>''],
            'model'=>User::class,
            'detail'=>'基本情報',
        ]);

        InfoTemplate::create([
            'id' => 5,
            'name' => '健康アンケート',
            'default'=>['main'=>'回答なし','comment'=>''],
            'model'=>User::class,
            'detail'=>'簡易版健康アンケート',
            'edit'=>['name'=>'回答','icon'=>'<i class="material-icons">question_answer</i>'],
        ]);

        InfoTemplate::create([
            'id' => 6,
            'name' => '避難/救助状況',
            'default'=>['rescue'=>config('kaigohack.rescue.unrescue'),'group'=>null,'rescuer'=>null,'info'=>[]],
            'model'=>User::class,
            'detail'=>'救助状況',
            'edit'=>['name'=>'回答','icon'=>'<i class="material-icons">question_answer</i>'],
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
            'default'=>['fami1'=>'','fami2'=>'','fami3'=>'','fami4'=>'','fami5'=>'','fami6'=>'','fami7'=>'','fami8'=>'','fami9'=>''],
            'model'=>User::class,
            'detail'=>'家族情報',
        ]);

        InfoTemplate::create([
            'id' => 9,
            'name' => '医療',
            'default'=>['care1'=>'36.2','care2'=>'170.0','care3'=>'60','care4'=>'','care5'=>'','care6'=>'','care7'=>'','care8'=>''],
            'model'=>User::class,
            'detail'=>'医療',
        ]);
        
        InfoTemplate::create([
            'id' => 10,
            'name' => '福祉',
            'default'=>['help1'=>'','help2'=>'','help3'=>'','help4'=>'','help5'=>'','help6'=>'','help7'=>'','help8'=>'','help9'=>'','use1'=>'利用しない','use2'=>'通常版','use3'=>'利用する'],
            'model'=>User::class,
            'detail'=>'福祉',
        ]);
    }
}
