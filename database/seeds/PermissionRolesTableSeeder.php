<?php

use Illuminate\Database\Seeder;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('permission_roles')->delete();

        $permissions = DB::table('permissions')->get();

        foreach ($permissions as $permission) {
            $permissionRoles[] = [
                'permission_id' => $permission->id,
                'role_id'       => 1
            ];
        }

    	DB::table('permission_roles')->insert($permissionRoles);
    }
}
