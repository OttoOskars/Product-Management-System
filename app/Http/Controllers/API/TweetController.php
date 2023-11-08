<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Retweet;
use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function createTweet(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tweet = new Tweet();
    
            if ($request->has('tweetText')) {
                $tweet->TweetText = $request->input('tweetText');
            }
    
            if ($request->hasFile('tweetImage')) {
                $image = $request->file('tweetImage');
                $path = $image->store('tweet_pictures', 'public');
                $tweet->TweetImage = $path;
            }
    
            $user->tweets()->save($tweet);
            $tweet->user = $user;
            $tweet->created_ago = 'now';
            $tweet->like_count = 0;
            $tweet->comment_count = 0;
            $tweet->retweet_count = 0;
            $tweet->isLiked = $this->checkIfLikedByUser($tweet, $user);
            $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, $user);
            $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, $user);
    
            return response()->json(['message' => 'Tweet created successfully', 'tweet' => $tweet], 201);
    
            $tweetCount = $tweets->count();
    
            return response()->json(['tweets' => $tweets, 'tweet_count' => $tweetCount]);
        } else {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }

    public function getTweets($type)
    {
        if (auth()->check()) {
            $user = auth()->user();
    
            $query = Tweet::with('user')
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
                ->orderBy('created_at', 'desc');
    
                if ($type === 'following') {
                    $query->whereIn('UserID', $user->follows->pluck('UserID')->push($user->UserID))->whereNotIn('UserID', [$user->UserID]);
                } elseif ($type === 'my') {
                    $query->where('UserID', $user->UserID);
                } elseif ($type === 'liked') {
                    $query->whereIn('tweets.TweetID', function ($subquery) use ($user) {
                        $subquery->select('TweetID')
                            ->from('likes')
                            ->where('UserID', $user->UserID);
                    });
                } elseif ($type === 'bookmark') {
                    $query->whereIn('tweets.TweetID', function ($subquery) use ($user) {
                        $subquery->select('TweetID')
                            ->from('bookmarks')
                            ->where('UserID', $user->UserID);
                    });
                }
    
            $tweets = $query->get();
    
            foreach ($tweets as $tweet) {
                $now = Carbon::now();
                $tweet->created_ago = $this->formatTimeAgo($tweet->created_at, $now);
                $tweet->isLiked = $this->checkIfLikedByUser($tweet, $user);
                $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, $user);
                $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, $user);
            }
    
            return response()->json(['tweets' => $tweets]);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }
    public function getUserLikedTweets($userTag)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tag = '@' . ltrim($userTag, '@');
            $user2 = User::where('UserTag', $tag)->first();
            if (!$user2) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $userID = $user2->UserID;
    
            $tweets = Tweet::with('user')
                ->join('likes', function($join) use ($userID) {
                    $join->on('tweets.TweetID', '=', 'likes.TweetID')
                        ->where('likes.UserID', $userID);
                })
                ->where(function ($q) use ($userID) {
                    $q->where('tweets.UserID', $userID)
                        ->orWhere('likes.UserID', $userID);
                })
                ->select('tweets.*', 'likes.created_at as likes_created_at')
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
                ->orderByRaw('IF(likes.created_at IS NOT NULL, likes.created_at, tweets.created_at) DESC');
    
            $tweets = $tweets->get();
    
            foreach ($tweets as $tweet) {
                $now = Carbon::now();
                $tweet->created_ago = $this->formatTimeAgo($tweet->created_at, $now);
                $tweet->isLiked = $this->checkIfLikedByUser($tweet, $user);
                $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, $user);
                $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, $user);
            }
    
            return response()->json(['tweets' => $tweets, 'tweet_count' => $tweets->count()]);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }
    public function getUserCommentedTweets($userTag)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tag = '@' . ltrim($userTag, '@');
            $user2 = User::where('UserTag', $tag)->first();
    
            if (!$user2) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            $userID = $user2->UserID;
    
            $tweets = Tweet::with(['user', 'comments' => function ($query) use ($userID) {
                $query->where('UserID', $userID)->orderBy('created_at', 'desc');;
            }])
            ->whereHas('comments', function ($query) use ($userID) {
                $query->where('UserID', $userID);
            })
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
            ->orderBy('tweets.created_at', 'desc')
            ->get();

            foreach ($tweets as $tweet) {
                $now = Carbon::now();
                $tweet->created_ago = $this->formatTimeAgo($tweet->created_at, $now);
                $tweet->isLiked = $this->checkIfLikedByUser($tweet, $user);
                $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, $user);
                $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, $user);
                foreach ($tweet->comments as $comment) {
                    $comment->created_ago = $this->formatTimeAgo($comment->created_at, $now);
                }
            }
    
            $tweetCount = $tweets->count();
    
            return response()->json(['tweets' => $tweets, 'tweet_count' => $tweetCount]);
        } else {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }
    public function getUserTweets($userTag)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tag = '@' . ltrim($userTag, '@');
            $user2 = User::where('UserTag', $tag)->first();
            $userID = $user2->UserID;
    
            $tweets = Tweet::with('user')
                ->leftJoin('retweets', function($join) use ($userID) {
                    $join->on('tweets.TweetID', '=', 'retweets.TweetID')
                        ->where('retweets.UserID', $userID);
                })
                ->where(function ($q) use ($userID) {
                    $q->where('tweets.UserID', $userID)
                        ->orWhere('retweets.UserID', $userID);
                })
                ->select('tweets.*', 'retweets.created_at as retweet_created_at')
                ->selectSub(function ($query) use ($user2) {
                    $query->from('retweets')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('retweets.TweetID', 'tweets.TweetID')
                        ->where('retweets.UserID', $user2->UserID); // Count the retweets by user2
                }, 'isRetweet')
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
                ->orderByRaw('IF(retweets.created_at IS NOT NULL, retweets.created_at, tweets.created_at) DESC');
    
            $tweets = $tweets->get();
    
            foreach ($tweets as $tweet) {
                $now = Carbon::now();
                $tweet->created_ago = $this->formatTimeAgo($tweet->created_at, $now);
                $tweet->isLiked = $this->checkIfLikedByUser($tweet, $user);
                $tweet->isRetweeted = $this->checkIfRetweetedByUser($tweet, $user);
                $tweet->isBookmarked = $this->checkIfBookmarkedByUser($tweet, $user);
            }
    
            return response()->json(['tweets' => $tweets, 'tweet_count' => $tweets->count()]);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
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
        $tweet->likes()->delete();
        $tweet->retweets()->delete();
        $tweet->bookmarks()->delete();
        $tweet->comments()->delete();
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