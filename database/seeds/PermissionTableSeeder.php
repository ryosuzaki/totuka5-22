<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name'=>'SuperAdmin']);

        Permission::create(['name'=>'groups.*']);
        Permission::create(['name'=>'groups.viewAny']);
        Permission::create(['name'=>'groups.create']);

        Permission::create(['name'=>'group.*']);
        Permission::create(['name'=>'group.update']);
        Permission::create(['name'=>'group.delete']);

        Permission::create(['name'=>'group_info_bases.*']);
        Permission::create(['name'=>'group_info_bases.create']);
        Permission::create(['name'=>'group_info_bases.delete']);

        Permission::create(['name'=>'group_info_base.*']);
        for($i=0;$i<5;$i++){
            Permission::create(['name'=>'group_info_base.'.$i.'.*']);
            Permission::create(['name'=>'group_info_base.'.$i.'.view']);
            Permission::create(['name'=>'group_info_base.'.$i.'.update']);
        }
        Permission::create(['name'=>'group_roles.*']);
        Permission::create(['name'=>'group_roles.viewAny']);
        Permission::create(['name'=>'group_roles.create']);
        Permission::create(['name'=>'group_roles.delete']);

        Permission::create(['name'=>'group_role.*']);
        for($i=1;$i<10;$i++){
            Permission::create(['name'=>'group_role.'.$i.'.*']);
            Permission::create(['name'=>'group_role.'.$i.'.update']);
            Permission::create(['name'=>'group_role.'.$i.'.viewUsers']);
            Permission::create(['name'=>'group_role.'.$i.'.inviteUser']);
            Permission::create(['name'=>'group_role.'.$i.'.removeUser']);
        }
    }
}
