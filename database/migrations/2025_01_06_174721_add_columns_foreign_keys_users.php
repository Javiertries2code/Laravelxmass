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
        Schema::table('users', function (Blueprint $table) {
              ///Changed by me
              $table->string('surname');
              $table->string('telephone1');
              $table->string('telephone2');
              $table->binary('photo')->nullable();

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['registration_id']);
            $table->dropForeign(['meeting_id']);
            $table->dropColumn(['surname', 'telephone1', 'telephone2', 'photo']);
        });
    }
};
