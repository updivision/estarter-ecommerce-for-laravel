<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('permissions')->delete();

    	$permissions = [
            ['name' => 'list_categories'],
            ['name' => 'create_category'],
            ['name' => 'update_category'],
            ['name' => 'delete_category'],
            ['name' => 'reorder_categories'],

            ['name' => 'list_products'],
            ['name' => 'create_product'],
            ['name' => 'update_product'],
            ['name' => 'clone_product'],
            ['name' => 'delete_product'],

            ['name' => 'list_attributes'],
            ['name' => 'create_attribute'],
            ['name' => 'update_attribute'],
            ['name' => 'delete_attribute'],

            ['name' => 'list_attribute_sets'],
            ['name' => 'create_attribute_set'],
            ['name' => 'update_attribute_set'],
            ['name' => 'delete_attribute_set'],

            ['name' => 'list_currencies'],
            ['name' => 'create_currency'],
            ['name' => 'update_currency'],
            ['name' => 'delete_currency'],

            ['name' => 'list_carriers'],
            ['name' => 'create_carrier'],
            ['name' => 'update_carrier'],
            ['name' => 'delete_carrier'],

            ['name' => 'list_taxes'],
            ['name' => 'create_tax'],
            ['name' => 'update_tax'],
            ['name' => 'delete_tax'],

            ['name' => 'list_order_statuses'],
            ['name' => 'create_order_status'],
            ['name' => 'update_order_status'],
            ['name' => 'delete_order_status'],
    	];

    	DB::table('permissions')->insert($permissions);
    }
}
