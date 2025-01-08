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
        Schema::table('users', function (Blueprint $table) {
            ///Changed by me
            $table->string('surname')->nullable();
            $table->string('telephone1')->nullable();
            $table->string('telephone2')->nullable();
            $table->binary('photo')->nullable();
            $table->enum('user_type', ['God','admin', 'teacher', 'student'])->nullable()->default(null);



            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->foreign('registration_id')->references('id')->on('registrations')->cascadeOnDelete();
            $table->foreign('meeting_id')->references('id')->on('meeting_user')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['registration_id']);
            $table->dropForeign(['meeting_id']);
            $table->dropColumn(['surname', 'telephone1', 'telephone2', 'photo', 'user_type']);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
};
