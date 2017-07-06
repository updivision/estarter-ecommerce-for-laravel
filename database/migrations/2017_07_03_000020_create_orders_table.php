<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     * @table orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('carrier_id')->unsigned();
            $table->integer('shipping_address_id')->unsigned();
            $table->integer('billing_address_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->mediumText('comment')->nullable()->default(null);
            $table->string('shipping_no', 50)->nullable()->default(null);
            $table->string('invoice_no', 50)->nullable()->default(null);
            $table->dateTime('invoice_date')->nullable()->default(null);
            $table->dateTime('delivery_date')->nullable()->default(null);
            $table->text('shipping_address')->nullable()->default(null);
            $table->text('billing_address')->nullable()->default(null);
            $table->decimal('total_discount', 13, 6)->nullable()->default(null);
            $table->decimal('total_discount_tax', 13, 6)->nullable()->default(null);
            $table->decimal('total_shipping', 13, 6)->nullable()->default(null);
            $table->decimal('total_shipping_tax', 13, 6)->nullable()->default(null);
            $table->decimal('total', 13, 6)->nullable()->default(null);
            $table->decimal('total_tax', 13, 6)->nullable()->default(null);
            $table->nullableTimestamps();


            $table->foreign('carrier_id')
                ->references('id')->on('carriers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('currency_id')
                ->references('id')->on('currencies')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('status_id')
                ->references('id')->on('order_statuses')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('orders');
     }
}
