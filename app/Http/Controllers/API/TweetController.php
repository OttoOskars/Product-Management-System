<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function createTweet(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $tweet = new Tweet();
    
        // Check if tweet text is provided
        if ($request->has('tweetText')) {
            $tweet->TweetText = $request->input('tweetText');
        }
    
        // Check if an image is provided
        if ($request->hasFile('tweetImage')) {
            $image = $request->file('tweetImage');
            $path = $image->store('tweet_pictures', 'public'); // Store the image in the "public" disk under the "tweet_pictures" directory
            $tweet->TweetImage = $path; // Store the image path in the database
        }
    
        // Save the tweet associated with the user
        $user->tweets()->save($tweet);
    
        return response()->json(['message' => 'Tweet created successfully', 'tweet' => $tweet], 201);
    }
    public function getAllTweets()
    {
        $tweets = Tweet::with('user')->orderBy('created_at', 'desc')->get();
    
        // Iterate through tweets and format the 'created_at' field
        foreach ($tweets as $tweet) {
            $now = Carbon::now();
            $tweet->created_ago = $this->formatTimeAgo($tweet->created_at, $now);
        }
    
        return response()->json(['tweets' => $tweets]);
    }
    
    private function formatTimeAgo($created_at, $now)
    {
        $diff = $created_at->diff($now);
    
        if ($diff->y > 0) {
            return $diff->y . 'y';
        } elseif ($diff->m > 0) {
            return $diff->m . 'm';
        } elseif ($diff->d > 0) {
            return $diff->d . 'd';
        } elseif ($diff->h > 0) {
            return $diff->h . 'h';
        } elseif ($diff->i > 0) {
            return $diff->i . 'm';
        } else {
            return $diff->s . 's';
        }
    }
    public function deleteTweet($id)
    {
        $tweet = Tweet::find($id);

        if (!$tweet) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }

        // Trigger the deletion of the tweet (and associated image)
        $tweet->delete();

        return response()->json(['message' => 'Tweet deleted successfully']);
    }
}