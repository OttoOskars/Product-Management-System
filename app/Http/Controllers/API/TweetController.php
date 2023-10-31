<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Retweet;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

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
            $path = $image->store('tweet_pictures', 'public');
            $tweet->TweetImage = $path;
        }

        $user->tweets()->save($tweet);

        return response()->json(['message' => 'Tweet created successfully', 'tweet' => $tweet], 201);
    }

    public function getAllTweets()
    {
        $tweets = Tweet::with('user')
            ->select('tweets.*')
            ->selectSub(function ($query) {
                $query->from('comments')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('comments.TweetID', 'tweets.TweetID');
            }, 'comment_count')
            ->selectSub(function ($query) {
                $query->from('likes')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('likes.TweetID', 'tweets.TweetID');
            }, 'like_count')
            ->selectSub(function ($query) {
                $query->from('retweets')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('retweets.TweetID', 'tweets.TweetID');
            }, 'retweet_count')
            ->selectSub(function ($query) {
                $query->from('bookmarks')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('bookmarks.TweetID', 'tweets.TweetID');
            }, 'bookmark_count')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($tweets as $tweet) {
            $now = Carbon::now();
            $tweet->created_ago = $this->formatTimeAgo($tweet->created_at, $now);
            
            // Assuming you have a function to check if the user has liked a tweet
            $tweet->isLiked = $this->checkIfLikedByUser($tweet, Auth::user());
            $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, Auth::user());
            $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, Auth::user());
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

        $tweet->delete();

        return response()->json(['message' => 'Tweet deleted successfully']);
    }

    public function getTweetData($id)
    {
        $tweet = Tweet::with('user')
            ->select('tweets.*')
            ->selectSub(function ($query) {
                $query->from('comments')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('comments.TweetID', 'tweets.TweetID');
            }, 'comment_count')
            ->selectSub(function ($query) {
                $query->from('likes')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('likes.TweetID', 'tweets.TweetID');
            }, 'like_count')
            ->selectSub(function ($query) {
                $query->from('retweets')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('retweets.TweetID', 'tweets.TweetID');
            }, 'retweet_count')
            ->selectSub(function ($query) {
                $query->from('bookmarks')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('bookmarks.TweetID', 'tweets.TweetID');
            }, 'bookmark_count')
            ->find($id);
    
        if (!$tweet) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }
            // Check if the user is authenticated
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            $tweet->isLiked = $this->checkIfLikedByUser($tweet, $user);
            $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, $user);
            $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, $user);
        }
        return response()->json(['tweet' => $tweet]);
    }
    
    // Add a function to check if a user has liked a tweet
    private function checkIfLikedByUser($tweet, $user)
    {
        return $tweet->likes->contains('UserID', $user->UserID);
    }
    private function checkIfRetweetedByUser($tweet, $user)
    {
        return $tweet->retweets->contains('UserID', $user->UserID);
    }
    private function checkIfBookmarkedByUser($tweet, $user)
    {
        return $tweet->bookmarks->contains('UserID', $user->UserID);
    }
}