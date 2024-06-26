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
            $table->text('description')->nullable();
            $table->integer('order_number');
            $table->timestamps();
        });

        Schema::dropIfExists('profiles_socials');
        Schema::create('profiles_socials', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('facebook_url',255)->nullable();
            $table->string('zalo_url',255)->nullable();
            $table->string('github_url',255)->nullable();
            $table->string('instagram_url',255)->nullable();
            $table->string('twitter_url',255)->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('profiles_avatars');
        Schema::create('profiles_avatars', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->text('image_avatar')->nullable();
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
