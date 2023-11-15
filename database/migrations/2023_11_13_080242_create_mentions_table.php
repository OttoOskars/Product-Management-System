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
        Schema::create('mentions', function (Blueprint $table) {
            $table->id('MentionID');
            $table->unsignedBigInteger('TweetID');
            $table->unsignedBigInteger('UserID'); // The user who made the mention
            $table->unsignedBigInteger('MentionedUserID'); // The user who was mentioned
            $table->foreign('TweetID')->references('TweetID')->on('tweets')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('users');
            $table->foreign('MentionedUserID')->references('UserID')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentions');
    }
};
