<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('salutation', 45)->nullable()->default(null);
            $table->date('birthday')->nullable()->default(null);
            $table->tinyInteger('gender')->nullable()->default(null);
            $table->tinyInteger('active')->default(0);
            $table->string('remember_token', 100)->nullable()->default(null);

            $table->unique(["email"], 'unique_users');
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
       Schema::dropIfExists('users');
     }
}