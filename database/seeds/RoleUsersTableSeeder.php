<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('role_users')->delete();

    	$roleUsers = [
    		[
                'role_id'  => 1,
                'user_id'  => 1
            ],
    	];

    	DB::table('role_users')->insert($roleUsers);
    }
}
