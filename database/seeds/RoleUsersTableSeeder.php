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
            // Set admin role for user id 1
    		[
                'role_id'  => 1,
                'user_id'  => 1
            ],
            // Set client role for user id 2
            [
                'role_id'  => 2,
                'user_id'  => 2
            ],
    	];

    	DB::table('role_users')->insert($roleUsers);
    }
}
