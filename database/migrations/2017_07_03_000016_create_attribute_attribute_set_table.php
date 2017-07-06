<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeAttributeSetTable extends Migration
{
    /**
     * Run the migrations.
     * @table attribute_attribute_set
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_attribute_set', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('attribute_id')->unsigned();
            $table->integer('attribute_set_id')->unsigned();


            $table->foreign('attribute_id')
                ->references('id')->on('attributes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('attribute_set_id')
                ->references('id')->on('attribute_sets')
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
       Schema::dropIfExists('attribute_attribute_set');
     }
}
