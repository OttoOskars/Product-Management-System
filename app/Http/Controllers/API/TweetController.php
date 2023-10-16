<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class TweetController extends Controller
{
    public function createTweet(Request $request)
    {
        $user = auth()->user();
        if(!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $tweet = new Tweet([
            'TweetText' => $request->tweetText,
            'TweetImage' => $request->tweetImage,
        ]);

        // Save the post associated with the user
        $user->tweets()->save($tweet);

        return response()->json(['message' => 'Post created successfully', 'post' => $tweet], 201);
    }
}