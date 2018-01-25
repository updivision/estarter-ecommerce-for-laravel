<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('orders')->delete();

    	$orders = [
    		[
                'user_id'             => 2,
                'status_id'           => 1,
                'carrier_id'          => 1,
                'shipping_address_id' => 1,
                'billing_address_id'  => 1,
                'billing_company_id'  => 1,
                'currency_id'         => 1,
                'comment'             => 'Lorem ipsum dolor sit amet.',
                'shipping_no'         => '123456',
                'invoice_no'          => '654321',
                'invoice_date'        => \Carbon\Carbon::now()->toDateTimeString(),
                'delivery_date'       => \Carbon\Carbon::now()->addDays(3)->toDateTimeString(),
                'total_discount'      => 0,
                'total_discount_tax'  => 0,
                'total_shipping'      => 20,
                'total_shipping_tax'  => 20,
                'total'               => '42.73',
                'total_tax'           => 45,
                'created_at'          => \Carbon\Carbon::now()->toDateTimeString()

    		],
    	];

    	DB::table('orders')->insert($orders);

        // Add products to order
        DB::table('order_product')->delete();

        $orderProducts = [
            [
                'product_id'     => 1,
                'order_id'       => 1,
                'name'           => 'T-Shirt',
                'sku'            => 1000,
                'price'          => '22.73',
                'price_with_tax' => 25,
                'quantity'       => 1
            ]
        ];

        DB::table('order_product')->insert($orderProducts);

        // Add order status history
        DB::table('order_status_history')->delete();

        $orderStatusHistory = [
            [
                'order_id'   => 1,
                'status_id'  => 1,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ];

        DB::table('order_status_history')->insert($orderStatusHistory);
    }
}
