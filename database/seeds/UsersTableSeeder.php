<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();

    	$users = [
    		'name'	        => 'Ecommerce Admin',
            'email'         => 'admin@ecommerce.com',
            'password'      => '$2y$10$QNf5iYdhmFxVn7OMrtZJQemkt46VPLZtGmU6ncJk3LERyd1r/zSqW', // Encrypted password is: adminpass
            'salutation'    => 'Mr.',
    		'birthday'		=> \Carbon\Carbon::now()->toDateString(),
    		'gender'		=> 1,
    		'active'		=> 1,
    	];

    	DB::table('users')->insert($users);
    }
}
