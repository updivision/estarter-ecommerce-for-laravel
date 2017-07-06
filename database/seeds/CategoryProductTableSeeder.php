<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('category_product')->delete();

    	$categoryProduct = [
    		[
				'category_id' => 1,
				'product_id'  => 1,
    		],
    	];

    	DB::table('category_product')->insert($categoryProduct);
    }
}
