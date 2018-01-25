<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     * @table notification_templates
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable()->default(null);
            $table->string('slug', 255)->unique()->nullable()->default(null);
            $table->string('model', 255)->nullable()->default(null);
            $table->longText('body')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('notification_templates');
     }
}
