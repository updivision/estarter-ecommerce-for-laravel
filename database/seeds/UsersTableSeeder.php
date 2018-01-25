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
            // Admin
            [
        		'name'	        => 'Admin',
                'email'         => 'admin@ecommerce.com',
                'password'      => '$2y$10$QNf5iYdhmFxVn7OMrtZJQemkt46VPLZtGmU6ncJk3LERyd1r/zSqW', // Encrypted password is: adminpass
                'salutation'    => 'Mr.',
        		'birthday'		=> \Carbon\Carbon::now()->toDateString(),
        		'gender'		=> 1,
        		'active'		=> 1,
                'created_at'    => \Carbon\Carbon::now()->toDateTimeString()
            ],
            // Client
            [
                'name'          => 'Client',
                'email'         => 'client@ecommerce.com',
                'password'      => '$2y$10$xxgI.2pRrN1H6LuxYJz.0.653AyqU4E1302xe.N4MOhv3uHM0Uqo2', // Encrypted password is: clientpass
                'salutation'    => 'Mr.',
                'birthday'      => \Carbon\Carbon::now()->subYears(20)->toDateString(),
                'gender'        => 1,
                'active'        => 1,
                'created_at'    => \Carbon\Carbon::now()->toDateTimeString()
            ],
    	];

    	DB::table('users')->insert($users);
    }
}
