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
            $table->string('telephone1')->nullable()->default(null);;
            $table->string('telephone2')->nullable()->default(null);;
            $table->binary('photo')->nullable()->default(null);;
            $table->enum('user_type', ['God','admin', 'teacher', 'student'])->nullable()->default(null);



            $table->unsignedBigInteger('registration_id')->nullable()->default(null);;
            $table->unsignedBigInteger('meeting_id')->nullable()->default(null);;
            $table->foreign('registration_id')->references('id')->on('registrations')->cascadeOnDelete()->default(null);;
            $table->foreign('meeting_id')->references('id')->on('meeting_user')->cascadeOnDelete()->default(null);;
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
