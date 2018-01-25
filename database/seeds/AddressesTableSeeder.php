<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('addresses')->delete();

    	$addresses = [
    		[
                'user_id'      => 2,
                'country_id'   => 178,
                'name'         => 'Jerry Williams',
                'address1'     => 'South Fabien Street',
                'address2'     => 'No. 34',
                'county'       => 'Bucharest',
                'city'         => 'Bucharest',
                'postal_code'  => '123456',
                'phone'        => '+413-26-9811311',
                'mobile_phone' => '+257-35-5785588',
                'comment'      => 'Lorem ipsum dolor sit amet.',
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString()

    		],
    	];

    	DB::table('addresses')->insert($addresses);
    }
}
