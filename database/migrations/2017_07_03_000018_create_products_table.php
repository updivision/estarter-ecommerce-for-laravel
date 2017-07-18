<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('attribute_set_id')->unsigned()->default('0');
            $table->string('name', 255)->nullable()->default(null);
            $table->longText('description')->nullable()->default(null);
            $table->integer('tax_id')->unsigned();
            $table->decimal('price', 13, 2)->nullable()->default(null);
            $table->string('sku', 100);
            $table->integer('stock')->nullable()->default('0');
            $table->tinyInteger('active')->default('0');
            $table->nullableTimestamps();

            $table->unique(["sku"], 'unique_skus');


            $table->foreign('attribute_set_id')
                ->references('id')->on('attribute_sets')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tax_id')
                ->references('id')->on('taxes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('group_id')
                ->references('id')->on('product_groups')
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
       Schema::dropIfExists('products');
     }
}
