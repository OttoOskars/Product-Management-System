<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use App\Models\CommentMention;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tweetId = $request->input('tweetId');
            $tweet = Tweet::find($tweetId);
            if (!$tweet) {
                return response()->json(['message' => 'Tweet not found'], 404);
            }
            $comment = new Comment();
            $commentText = $request->input('commentText');
            if ($request->has('commentText')) {
                $comment->CommentText = $request->input('commentText');
                $mentions = $this->extractMentions($comment->CommentText);
            }
    
/*             if ($request->hasFile('commentImage')) {
                $image = $request->file('commentImage');
                $path = $image->store('comment_pictures', 'public');
                $comment->CommentImage = $path;
            } */
            $comment->UserID = $user->UserID;
            $comment->TweetID = $tweet->TweetID;
            $tweet->comments()->save($comment);
            if (!empty($mentions)) {
                foreach ($mentions as $mention) {
                    $mentionModel = new CommentMention([
                        'MentionedUserID' => $mention->UserID,
                        'UserID' => $user->UserID,
                    ]);
                    $comment->comment_mentions()->save($mentionModel);
                }
            }
            $comment->user = $user;
            $comment->created_ago = 'now';
            return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
        } else {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }

    private function extractMentions($Text)
    {
        preg_match_all('/@(\w+)/u', $Text, $matches);
    
        $usernames = $matches[1];
        $usernamesWithAtSymbol = array_map(function ($username) {
            return '@' . $username;
        }, $usernames);
        return User::whereIn('UserTag', $usernamesWithAtSymbol)->get();
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $comment->comment_mentions()->delete();
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function getCommentsByTweet($tweetId)
    {
        $tweet = Tweet::find($tweetId);
        if (!$tweet) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }
        $comments = Comment::with('user')->where('TweetID', $tweetId)->orderBy('created_at', 'desc')->get();
        $now = Carbon::now();
        foreach ($comments as $comment) {
            $comment->created_ago = $this->formatTimeAgo($comment->created_at, $now);
        }
        return response()->json(['comments' => $comments]);
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
}