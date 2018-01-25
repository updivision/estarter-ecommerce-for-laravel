<?php

use Illuminate\Database\Seeder;

class CarriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('carriers')->delete();

    	$carriers = [
    		[
                'name'  => 'Best Express',
                'price'  => '20',
                'delivery_text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
				'logo'  => null,
    		],
    	];

    	DB::table('carriers')->insert($carriers);
    }
}
