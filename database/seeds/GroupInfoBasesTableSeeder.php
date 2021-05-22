<?php

use Illuminate\Database\Seeder;

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
        DB::table('group_info_bases')->insert([
            [
                'id' => 1,
                'name' => '基本情報',
                'icon'=>'<span class="material-icons">info</span>'
            ],
            [
                'id' => 2,
                'name' => '混雑状況',
                'icon'=>'<span class="material-icons">groups</span>'
            ]
        ]);
    }
}
