<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoTemplate;

class UserTableSeeder extends Seeder
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
            'id' => 4,
            'name' => 'ユーザー情報',
            'default'=>['detail'=>''],
        ]);
    }
}
