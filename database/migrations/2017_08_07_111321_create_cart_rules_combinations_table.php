<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartRulesCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_rules_combinations', 
            function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('cart_rule_id_1')->unsigned();
            $table->integer('cart_rule_id_2')->unsigned();
          
            $table->foreign('cart_rule_id_1')
                ->references('id')->on('cart_rules')  
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cart_rule_id_2')
                ->references('id')->on('cart_rules')  
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
        Schema::dropIfExists('cart_rules_combinations');
    }
}
