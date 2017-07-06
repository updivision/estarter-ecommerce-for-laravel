<?php

use Illuminate\Database\Seeder;

class AttributeSetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('attribute_sets')->delete();

    	$attributeSets = [
    		[
				'name' => 'Clothes',
    		],
    	];

    	DB::table('attribute_sets')->insert($attributeSets);
    }
}
