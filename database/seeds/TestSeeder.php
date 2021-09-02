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
        Group::setUp($user->id,'戸塚小学校',GroupType::findByName('shelter'));

        $spot1=Group::setUp($user->id,'土砂崩れ',GroupType::findByName('danger_spot'));
        $spot1->setLocation(35.43167251138229, 139.5744799078513);

        $spot2=Group::setUp($user->id,'火災',GroupType::findByName('danger_spot'));
        $spot2->setLocation(35.42400747938056, 139.5608362675648);

        $group=Group::setUp($user->id,'戸塚ラボ',GroupType::findByName('nursing_home'));
        $group->createRole('職員','aaaa');
        $group->createRole('利用者','aaaa');

        Group::setUp($user1->id,'土砂崩れ',GroupType::findByName('danger_spot'));
        Group::setUp($user1->id,'戸塚中学校',GroupType::findByName('shelter'));

        $nomata=Group::setUp($user->id,'俣野公園',GroupType::findByName('shelter'));
        $nomata->setLocation(35.38854828072417, 139.49249957722563);

        $meiji=Group::setUp($user->id,'横浜市児童遊園地',GroupType::findByName('shelter'));
        $meiji->setLocation(35.437304567109145, 139.57815076473577);

    }
}
