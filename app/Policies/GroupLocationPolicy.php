<?php

namespace App\Policies;

use App\Models\Group\GroupLocation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any group locations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the group location.
     *
     * @param  \App\User  $user
     * @param  \App\GroupLocation  $groupLocation
     * @return mixed
     */
    public function view(User $user, GroupLocation $groupLocation)
    {
        //
    }

    /**
     * Determine whether the user can create group locations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the group location.
     *
     * @param  \App\User  $user
     * @param  \App\GroupLocation  $groupLocation
     * @return mixed
     */
    public function update(User $user, GroupLocation $groupLocation)
    {
        //
    }

    /**
     * Determine whether the user can delete the group location.
     *
     * @param  \App\User  $user
     * @param  \App\GroupLocation  $groupLocation
     * @return mixed
     */
    public function delete(User $user, GroupLocation $groupLocation)
    {
        //
    }

    /**
     * Determine whether the user can restore the group location.
     *
     * @param  \App\User  $user
     * @param  \App\GroupLocation  $groupLocation
     * @return mixed
     */
    public function restore(User $user, GroupLocation $groupLocation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the group location.
     *
     * @param  \App\User  $user
     * @param  \App\GroupLocation  $groupLocation
     * @return mixed
     */
    public function forceDelete(User $user, GroupLocation $groupLocation)
    {
        //
    }
}
