<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremissionAndRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premissions',function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('roles',function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('premission_user',function(Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('premission_id');
            $table->foreign('premission_id')->references('id')->on('premissions')->cascadeOnDelete();
            $table->unique(['user_id','premission_id']);
        });
       
        Schema::create('role_user',function(Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->unique(['user_id','role_id']);
        });

        Schema::create('premission_role',function(Blueprint $table){
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->unsignedBigInteger('premission_id');
            $table->foreign('premission_id')->references('id')->on('premissions')->cascadeOnDelete();
            $table->unique(['role_id','premission_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('premission_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('premissions');
    }
}
