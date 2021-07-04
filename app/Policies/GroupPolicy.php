<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    //
    public function update(User $user, Group $group)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group.update');
    }

    //
    public function delete(User $user, Group $group)
    {
        return $user->getRoleByGroup($group->id)->hasPermissionTo('group.delete');
    }
}
