<?php

use Illuminate\Database\Seeder;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

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
        
        $spot1=Group::setUp($user->id,'土砂崩れ',GroupType::findByName('danger_spot'));
        $spot1->setLocation(35.43167251138229, 139.5744799078513);

        $spot2=Group::setUp($user->id,'火災',GroupType::findByName('danger_spot'));
        $spot2->setLocation(35.42400747938056, 139.5608362675648);

        $group=Group::setUp($user->id,'戸塚ラボ',GroupType::findByName('nursing_home'));
        $group->createRole('職員','aaaa');
        $group->createRole('利用者','aaaa');

        Group::setUp($user1->id,'土砂崩れ',GroupType::findByName('danger_spot'));

    }
}
