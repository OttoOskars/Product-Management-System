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
        $tweetId = $request->input('tweetId'); // Assuming the request contains the tweet_id
        $commentText = $request->input('commentText');

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tweet = Tweet::find($tweetId);

        if (!$tweet) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }

        // Create a new comment
        $comment = new Comment();
        $comment->CommentText = $commentText;
        $comment->UserID = $user->UserID;

        $tweet->comments()->save($comment);

        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Check if the authenticated user has the permission to delete the comment (e.g., it's their comment)

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function getCommentsByTweet($tweetId)
    {
        // First, find the tweet by its ID to ensure it exists
        $tweet = Tweet::find($tweetId);
    
        if (!$tweet) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }
    
        // Retrieve all comments for the specific tweet with their associated users
        $comments = Comment::with('user')->where('TweetID', $tweetId)->orderBy('created_at', 'desc')->get();
    
        // Iterate through comments and format the 'created_at' field
        $now = Carbon::now();
        foreach ($comments as $comment) {
            $comment->created_ago = $this->formatTimeAgo($comment->created_at, $now);
        }
    
        return response()->json(['comments' => $comments]);
    }
}