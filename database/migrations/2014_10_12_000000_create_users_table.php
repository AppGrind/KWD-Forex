<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_subscribed')->default(true);
            $table->string('code')->nullable();
            $table->string('status_is');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('displayname')->unique();
            $table->string('contactnumber');
            $table->string('address');
            $table->string('town');
            $table->string('province');
            $table->integer('postalcode')->unsigned()->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('lastloggedin_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
