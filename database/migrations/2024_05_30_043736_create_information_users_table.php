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
        Schema::create('information_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('full_name', 255);
            $table->string('work_experience', 255)->nullable();
            $table->string('position_application', 255)->nullable();
            $table->string('phone_number', 255);
            $table->string('day');
            $table->string('month');
            $table->string('year');
            $table->string('birthday_inder', 255);
            $table->string('address', 500);
            $table->string('gender', 50)->comment('0: male, 1: female, 3: other');;
            $table->string('email', 191)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_users');
    }
};
