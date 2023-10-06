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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('CommentID');
            $table->string('CommentText');
            $table->unsignedBigInteger('TweetID');
            $table->unsignedBigInteger('UserID');
            $table->foreign('TweetID')->references('TweetID')->on('tweets');
            $table->foreign('UserID')->references('UserID')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
