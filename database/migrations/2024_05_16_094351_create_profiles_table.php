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
        Schema::dropIfExists('profiles_contents');
        Schema::create('profiles_contents', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('icon', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('description', 500)->nullable();
            $table->integer('order_number');
            $table->timestamps();
        });

        Schema::dropIfExists('profiles_socials');
        Schema::create('profiles_socials', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('icon', 500)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('link_url')->nullable();
            $table->integer('order_number');
            $table->timestamps();
        });

        Schema::dropIfExists('profiles_avatars');
        Schema::create('profiles_avatars', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('avatar_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles_contents');
        Schema::dropIfExists('profiles_socials');
        Schema::dropIfExists('profiles_avatars');
    }
};
