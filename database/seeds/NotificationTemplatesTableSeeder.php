<?php

use Illuminate\Database\Seeder;

class NotificationTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('notification_templates')->delete();

    	$notificationTemplates = [
    		[
                'name'  => 'Order Status Changed',
                'slug'  => 'order-status-changed',
                'model' => 'Order',
                'body'  => '<p>Hello,&nbsp;&nbsp;{{ userName }},</p>
                            <p>Your order status was changed to&nbsp;&nbsp;{{ status }}.</p>

                            <p>Best,</p>
                            <p>eStarter team.</p>',
    		],
    	];

    	DB::table('notification_templates')->insert($notificationTemplates);
    }
}
