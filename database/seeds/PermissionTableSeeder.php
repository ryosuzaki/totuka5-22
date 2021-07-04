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
        /*
        Permission::create(['name'=>'groups.*']);
        Permission::create(['name'=>'groups.viewAny']);
        Permission::create(['name'=>'groups.create']);
        */
        Permission::create(['name'=>'group.*']);
        foreach(config('group.role.group') as $action){
            Permission::create(['name'=>'group.'.$action]);
        }

        Permission::create(['name'=>'group_info_bases.*']);
        foreach(config('group.role.group_info_bases') as $action){
            Permission::create(['name'=>'group_info_bases.'.$action]);
        }

        Permission::create(['name'=>'group_info.*']);
        for($i=0;$i<5;$i++){
            Permission::create(['name'=>'group_info.'.$i.'.*']);
            foreach(config('group.role.group_info') as $action){
                Permission::create(['name'=>'group_info.'.$i.'.'.$action]);
            }
        }


        Permission::create(['name'=>'group_roles.*']);
        foreach(config('group.role.group_roles') as $action){
            Permission::create(['name'=>'group_roles.'.$action]);
        }

        Permission::create(['name'=>'group_role.*']);
        for($i=1;$i<10;$i++){
            Permission::create(['name'=>'group_role.'.$i.'.*']);
            foreach(config('group.role.group_role') as $action){
                Permission::create(['name'=>'group_role.'.$i.'.'.$action]);
            }
        }
    }
}
