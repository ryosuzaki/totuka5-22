<?php

namespace App\Traits;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


/**
 * 
 */
trait DeletePermissionAndRole
{
    public function deletePermission(Permission $permission){
        $permission->users()->delete();
        $permission->roles()->detach();
        $permission->delete();
        return true;
    }

    public function deleteRole(Role $role){
        $role->users()->delete()
        $role->permissions()->detach();
        $role->delete();
        return true;
    }
}
