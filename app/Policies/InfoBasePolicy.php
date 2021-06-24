<?php

namespace App\Policies;

use App\Models\Info\InfoBase;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InfoBasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any info bases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the info base.
     *
     * @param  \App\User  $user
     * @param  \App\InfoBase  $infoBase
     * @return mixed
     */
    public function view(User $user, InfoBase $infoBase)
    {
        //
    }

    /**
     * Determine whether the user can create info bases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the info base.
     *
     * @param  \App\User  $user
     * @param  \App\InfoBase  $infoBase
     * @return mixed
     */
    public function update(User $user, InfoBase $infoBase)
    {
        //
    }

    /**
     * Determine whether the user can delete the info base.
     *
     * @param  \App\User  $user
     * @param  \App\InfoBase  $infoBase
     * @return mixed
     */
    public function delete(User $user, InfoBase $infoBase)
    {
        //
    }

    /**
     * Determine whether the user can restore the info base.
     *
     * @param  \App\User  $user
     * @param  \App\InfoBase  $infoBase
     * @return mixed
     */
    public function restore(User $user, InfoBase $infoBase)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the info base.
     *
     * @param  \App\User  $user
     * @param  \App\InfoBase  $infoBase
     * @return mixed
     */
    public function forceDelete(User $user, InfoBase $infoBase)
    {
        //
    }
}
