<?php

use Illuminate\Database\Seeder;

class AttributeAttributeSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('attribute_attribute_set')->delete();

    	$attributeAttributeSet = [
    		[
                'attribute_id'      => 1,
                'attribute_set_id' => 1,
    		],
    		[
                'attribute_id'      => 2,
                'attribute_set_id' => 1,
    		],
    	];

    	DB::table('attribute_attribute_set')->insert($attributeAttributeSet);
    }
}
