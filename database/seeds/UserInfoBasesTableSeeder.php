<?php

use Illuminate\Database\Seeder;

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
        DB::table('user_info_bases')->insert([
            [
                'id' => 1,
                'name' => '情報',
                'icon'=>'<i class="material-icons">health_and_safety</i>',
            ]
        ]);
    }
}
