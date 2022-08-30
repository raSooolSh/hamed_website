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
            $table->id()->startingValue(1000);
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('type',['user','admin','moderator'])->default('user');
            $table->string('phone_number')->unique();
            $table->string('meli_code')->unique();
            $table->string('password');
            $table->string('avatar')->default('images/users/default.jpg');
            $table->boolean('is_block')->default(0);
            $table->text('block_reason')->nullable();
            $table->rememberToken();
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
