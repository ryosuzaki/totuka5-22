<?php

use Illuminate\Database\Seeder;

use App\UserInfoBase;

class UserInfoBasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserInfoBase::create([
            'id' => 1,
            'name' => '身辺情報',
            'icon'=>'<i class="material-icons">health_and_safety</i>',
            'default_info'=>['info'=>''],
        ]);
    }
}
