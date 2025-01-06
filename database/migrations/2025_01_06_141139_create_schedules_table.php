<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day_week');
            $table->integer('hour');

            // $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            // $table->foreignId('subject_id')->nullable()->constrained('subjects')->cascadeOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();


           $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
           $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnDelete();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('schedules');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
};
