<?php

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('taxes')->delete();

    	$taxes = [
    		[
				'name'  => 'VAT',
				'value' => '10.000000',
    		],
    	];

    	DB::table('taxes')->insert($taxes);
    }
}
