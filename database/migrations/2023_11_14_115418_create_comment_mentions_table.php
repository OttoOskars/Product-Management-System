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
        Schema::create('comment_mentions', function (Blueprint $table) {
            $table->id('MentionID');
            $table->unsignedBigInteger('CommentID');
            $table->unsignedBigInteger('UserID'); // The user who made the mention
            $table->unsignedBigInteger('MentionedUserID'); // The user who was mentioned
            $table->foreign('CommentID')->references('CommentID')->on('comments');
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
        Schema::dropIfExists('comment_mentions');
    }
};