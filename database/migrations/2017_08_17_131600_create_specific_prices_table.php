<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specific_prices', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('reduction', 13, 2)->nullable()->default(0);
            $table->enum('discount_type', array('Amount', 'Percent'));
            $table->dateTime('start_date');
            $table->dateTime('expiration_date');
            $table->integer('product_id')->unsigned()->nullable();
            // $table->integer('currency_id')->unsigned()->nullable();

            // Foreign keys
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');

            // $table->foreign('currency_id')
            //     ->references('id')->on('currencies')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specific_prices');
    }
}
