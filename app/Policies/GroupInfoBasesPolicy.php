<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupInfoBasesPolicy
{
    //
    public function viewAny(User $user, Group $group)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_info_bases.viewAny');
    }
    //
    public function create(User $user, Group $group)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_info_bases.create');
    }
    //
    public function update(User $user, Group $group)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_info_bases.update');
    }
    //
    public function delete(User $user, Group $group)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group_info_bases.delete');
    }
}
