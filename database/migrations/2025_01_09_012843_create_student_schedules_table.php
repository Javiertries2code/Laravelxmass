<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day_week');
            $table->softDeletes();


            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();

            $table->unsignedBigInteger('hour_1')->nullable();
           $table->foreign('hour_1')->references('id')->on('subjects')->cascadeOnDelete();

            $table->unsignedBigInteger('hour_2')->nullable();
           $table->foreign('hour_2')->references('id')->on('subjects')->cascadeOnDelete();

            $table->unsignedBigInteger('hour_3')->nullable();
           $table->foreign('hour_3')->references('id')->on('subjects')->cascadeOnDelete();

            $table->unsignedBigInteger('hour_4')->nullable();
           $table->foreign('hour_4')->references('id')->on('subjects')->cascadeOnDelete();

            $table->unsignedBigInteger('hour_5')->nullable();
           $table->foreign('hour_5')->references('id')->on('subjects')->cascadeOnDelete();

            $table->unsignedBigInteger('hour_6')->nullable();
           $table->foreign('hour_6')->references('id')->on('subjects')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_schedules');
    }
};
