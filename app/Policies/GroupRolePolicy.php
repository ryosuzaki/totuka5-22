<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupRolePolicy
{
    public function update(User $user, Group $group, int $index)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_role.'.$index.'.update');
    }
    //
    public function viewUsers(User $user, Group $group, int $index){
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_role.'.$index.'.viewUsers');
    }
    //
    public function inviteUser(User $user, Group $group, int $index){
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_role.'.$index.'.inviteUser');
    }
    //
    public function removeUser(User $user, Group $group, int $index){
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_role.'.$index.'.removeUser');
    }
}
