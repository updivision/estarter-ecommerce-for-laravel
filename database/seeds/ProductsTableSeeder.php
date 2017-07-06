<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('products')->delete();

    	$products = [
    		[
                'id'                => 1,
                'group_id'          => 1,
                'attribute_set_id' => 1,
                'name'              => 'T-Shirt',
                'description'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus laoreet lacus ipsum, a aliquam libero sollicitudin vel. Nunc gravida rutrum dolor vitae vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras lacinia accumsan turpis, ut iaculis orci tincidunt a. Aliquam dignissim nibh justo, a imperdiet arcu convallis vel. Morbi ultricies tempor turpis, sit amet condimentum ipsum eleifend a. Vestibulum enim purus, imperdiet sed laoreet vel, condimentum ac urna. Nulla vitae mattis lectus, hendrerit rutrum urna. Maecenas luctus dolor in aliquam ultricies. Maecenas volutpat volutpat iaculis.</p>',
                'tax_id'            => 1,
                'price'             => '22.727273',
                'sku'               => 1000,
                'stock'             => 1,
                'active'            => 1
    		],
    	];

    	DB::table('products')->insert($products);
    }
}
