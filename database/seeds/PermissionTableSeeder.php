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
        Permission::create(['name'=>'groups.*']);
        Permission::create(['name'=>'groups.viewAny']);
        Permission::create(['name'=>'groups.create']);

        Permission::create(['name'=>'group.*']);
        Permission::create(['name'=>'group.view']);
        Permission::create(['name'=>'group.update']);
        Permission::create(['name'=>'group.delete']);

        Permission::create(['name'=>'group.info_bases.*']);
        Permission::create(['name'=>'group.info_bases.viewAny']);
        Permission::create(['name'=>'group.info_bases.create']);

        Permission::create(['name'=>'group.info_base.*']);
        for($i=0;$i<5;$i++){
            Permission::create(['name'=>'group.info_base.'.$i.'.*']);
            Permission::create(['name'=>'group.info_base.'.$i.'.view']);
            Permission::create(['name'=>'group.info_base.'.$i.'.update']);
            Permission::create(['name'=>'group.info_base.'.$i.'.delete']);
        }
        Permission::create(['name'=>'group.roles.*']);
        Permission::create(['name'=>'group.roles.viewAny']);
        Permission::create(['name'=>'group.roles.create']);

        Permission::create(['name'=>'group.role.*']);
        for($i=0;$i<10;$i++){
            Permission::create(['name'=>'group.role.'.$i.'.*']);
            Permission::create(['name'=>'group.role.'.$i.'.view']);
            Permission::create(['name'=>'group.role.'.$i.'.update']);
            Permission::create(['name'=>'group.role.'.$i.'.delete']);

            Permission::create(['name'=>'group.role.'.$i.'.users.*']);
            Permission::create(['name'=>'group.role.'.$i.'.users.viewAny']);
            Permission::create(['name'=>'group.role.'.$i.'.users.update']);
            Permission::create(['name'=>'group.role.'.$i.'.users.invite']);
            Permission::create(['name'=>'group.role.'.$i.'.users.remove']);
        }
    }
}
