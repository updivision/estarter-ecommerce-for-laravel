<?php

use Illuminate\Database\Seeder;

class ProductGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('product_groups')->delete();

    	$productGroups = [
    		[
				'id'   => 1,
    		],
    	];

    	DB::table('product_groups')->insert($productGroups);
    }
}
