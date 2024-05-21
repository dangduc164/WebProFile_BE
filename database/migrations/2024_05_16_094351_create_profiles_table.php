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
        Schema::dropIfExists('profiles_content');
        Schema::create('profiles_content', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('icon', 255);
            $table->string('title', 255);
            $table->string('description');
            $table->string('order_number');
            $table->timestamps();
        });

        Schema::dropIfExists('profiles_social');
        Schema::create('profiles_social', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('icon', 255);
            $table->string('title', 255);
            $table->string('link_url');
            $table->string('order_number');
            $table->timestamps();
        });

        Schema::dropIfExists('profiles_avatars');
        Schema::create('profiles_avatars', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('avatar_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles_content');
        Schema::dropIfExists('profiles_social');
        Schema::dropIfExists('profiles_avatars');
    }
};
