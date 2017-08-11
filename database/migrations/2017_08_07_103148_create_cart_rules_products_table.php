<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartRulesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_rules_products', 
            function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('cart_rule_id')->unsigned();
            $table->integer('product_id')->unsigned();
          
            $table->foreign('cart_rule_id')
                ->references('id')->on('cart_rules')  
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_rules_products');
    }
}
