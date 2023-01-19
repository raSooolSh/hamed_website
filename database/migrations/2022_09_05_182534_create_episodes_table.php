<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');

            $table->integer('number');

            $table->unique(['section_id','number']);
            $table->unique(['course_id','number']);

            $table->string('video');
            $table->boolean('is_free')->defualt('0');
            $table->timestamps();
        });

        Schema::create('episode_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('episode_id');
            $table->foreign('episode_id')->references('id')->on('episodes')->cascadeOnDelete();

            $table->integer('request')->default(0);

            $table->unique(['user_id','episode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode_user');

        Schema::dropIfExists('episodes');
    }
}
