<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('companies')->delete();

    	$companies = [
    		[
                'user_id'  => 2,
                'name'     => 'Company Name',
                'address1' => 'Flowers street',
                'address2' => 'No. 25',
                'county'   => 'Bucharest',
                'city'     => 'Bucharest',
                'tin'      => '12345678',
                'trn'      => 'J1/123/2000',

    		],
    	];

    	DB::table('companies')->insert($companies);
    }
}
