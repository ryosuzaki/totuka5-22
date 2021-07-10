<?php

use Illuminate\Database\Seeder;

use App\Models\Group\Group;
use App\User;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::setup('aaa','cars1201023@gn.iwasaki.ac.jp','aaaa');
        $user1=User::setup('bbb','ryo.yakizakana12@gmail.com','aaaa');
        $user->useGroupType('nursing_home');
        Group::setUp($user->id,'戸塚小学校','shelter','aaaa');
        Group::setUp($user->id,'土砂崩れ','danger_spot',$user->id);
        $group=Group::setUp($user->id,'戸塚ラボ','nursing_home','aaaa');
        $group->createRole('職員','aaaa');
        $group->createRole('利用者','aaaa');

        Group::setUp($user1->id,'土砂崩れ','danger_spot',$user1->id);
        Group::setUp($user1->id,'戸塚中学校','shelter','aaaa');
    }
}
