<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('phone', 16);
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('access_token', 32)->unique()->nullable();
            $table->dateTime('access_token_expired')->nullable();
            $table->enum('status', ['not_confirmed', 'confirmed', 'blocked', 'deleted'])->default('not_confirmed');
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
