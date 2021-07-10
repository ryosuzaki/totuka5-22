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
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group.update');
    }

    //
    public function delete(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group.delete');
    }
}
