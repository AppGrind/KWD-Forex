<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_notify')->create('notifications', function (Blueprint $table) {
            $table->integer('id');
            $table->string('reference_number')->nullable();
            $table->longText('message');
            $table->integer('viewed')->unsigned();
            $table->string('type');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_notify')->dropIfExists('notifications');
    }
}
