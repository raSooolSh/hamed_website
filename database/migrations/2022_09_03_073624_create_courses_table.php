<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name_fa');
            $table->string('name_en');
            $table->string('slug');
            $table->text('description');
            $table->string('image');
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('discount_off')->nullable();
            $table->timestamp('discount_expire_at')->nullable();
            $table->longText('content')->nullable();
            $table->string('teacher');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('course_user' , function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->integer('course_price');
            $table->integer('payment_price');
            $table->string('discount_code')->nullable();
            $table->enum('discount_type',['value','percent'])->nullable();
            $table->integer('discount_off')->nullable();
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
        Schema::dropIfExists('course_user');
        Schema::dropIfExists('courses');
    }
}
