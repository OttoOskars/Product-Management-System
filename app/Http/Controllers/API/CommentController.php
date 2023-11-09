<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Comment;
use App\Models\Tweet;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $user = auth()->user();
        $tweetId = $request->input('tweetId');
        $commentText = $request->input('commentText');
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $tweet = Tweet::find($tweetId);
        if (!$tweet) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }
        $comment = new Comment();
        $comment->CommentText = $commentText;
        $comment->UserID = $user->UserID;
        $tweet->comments()->save($comment);
        $comment->user = $user;
        $comment->created_ago = 'now';
        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
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