<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('order_statuses')->delete();

    	$orderStatuses = [
    		[
                'name'  => 'Pending',
                'notification'  => 1,
    		],
            [
                'name'  => 'Processed',
                'notification'  => 1,
            ],
            [
                'name'  => 'Delivered',
                'notification'  => 1,
            ],
            [
                'name'  => 'Done',
                'notification'  => 0,
            ],
    	];

    	DB::table('order_statuses')->insert($orderStatuses);
    }
}
