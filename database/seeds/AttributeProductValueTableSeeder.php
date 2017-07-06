<?php

use Illuminate\Database\Seeder;

class AttributeProductValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('attribute_product_value')->delete();

    	$attributeProductValue = [
    		[
				'product_id'   => 1,
				'attribute_id' => 1,
				'value'        => 'Black',
    		],
    		[
				'product_id'   => 1,
				'attribute_id' => 2,
				'value'        => 'S',
    		],
    	];

    	DB::table('attribute_product_value')->insert($attributeProductValue);
    }
}
