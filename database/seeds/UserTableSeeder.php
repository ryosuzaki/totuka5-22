<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoTemplate;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        ]);
    }
}
