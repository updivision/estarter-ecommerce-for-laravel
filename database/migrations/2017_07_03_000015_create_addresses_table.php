<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     * @table addresses
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->string('name', 100)->nullable()->default(null);
            $table->string('address1', 255)->nullable()->default(null);
            $table->string('address2', 255)->nullable()->default(null);
            $table->string('county', 255)->nullable()->default(null);
            $table->string('city', 255)->nullable()->default(null);
            $table->string('postal_code', 50)->nullable()->default(null);
            $table->string('phone', 50)->nullable()->default(null);
            $table->string('mobile_phone', 50)->nullable()->default(null);
            $table->mediumText('comment')->nullable()->default(null);
            $table->nullableTimestamps();


            $table->foreign('country_id')
                ->references('id')->on('countries')
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
       Schema::dropIfExists('addresses');
     }
}
