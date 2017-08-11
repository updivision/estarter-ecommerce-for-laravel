<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartRulesCustomerGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_rules_customer_groups', function (Blueprint $table) 
        {
            $table->engine = 'InnoDB';
            $table->integer('cart_rule_id')->unsigned();
            $table->integer('customer_id')->unsigned();


            $table->foreign('cart_rule_id')
                ->references('id')->on('cart_rules')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('customer_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('cart_rules_customer_groups');
    }
}
