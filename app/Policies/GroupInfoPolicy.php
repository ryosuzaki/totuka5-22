<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupInfoPolicy
{
    //
    public function view(User $user, Group $group,int $index)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_info.'.$index.'.view');
    }

    //
    public function update(User $user, Group $group,int $index)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_info.'.$index.'.update');
    }
}
