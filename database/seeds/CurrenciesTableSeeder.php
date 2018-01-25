<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('currencies')->delete();

    	$currencies = [
    		[
                'name'  => 'Euro',
                'iso'  => 'EUR',
                'value' => '1',
				'default'  => '1',
    		],
    	];

    	DB::table('currencies')->insert($currencies);
    }
}
