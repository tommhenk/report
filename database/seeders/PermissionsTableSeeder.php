<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name'=>'ORDER_ADMIN'],
            ['name'=>'CLIENT_ADMIN'],
            ['name'=>'EMPLOYEE_ADMIN'],
        ]);

        $roles = \App\Models\Role::get();
        $permissionIds = \App\Models\Permission::pluck('id');
        foreach($roles as $role){
            if($role->name == 'admin'){
                foreach ($permissionIds as $id) {
                    $role->perms()->attach($id);
                }
            }
            elseif($role->name == 'client'){
                foreach ($permissionIds as $id) {
                    if (\App\Models\Permission::find($id)->name == 'ORDER_ADMIN') {
                        $role->perms()->attach($id);
                    }
                }
            }
            elseif($role->name == 'employee'){
                foreach ($permissionIds as $id) {
                    if (\App\Models\Permission::find($id)->name == 'ORDER_ADMIN') {
                        $role->perms()->attach($id);
                    }
                }
            }
        }
    }
}
