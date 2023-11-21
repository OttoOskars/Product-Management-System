<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\RetweetController;
use App\Http\Controllers\API\FollowController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookmarkController;

Route::post('check-email', [UserController::class, 'checkEmail']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Use GET for fetching user information, and protect it with the auth:sanctum middleware
Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getUser']);
Route::middleware('auth:sanctum')->post('tweets', [TweetController::class, 'createTweet']);
Route::middleware('auth:sanctum')->post('/create-comments', [CommentController::class, 'createComment']);

Route::middleware('auth:sanctum')->get('/get-user/{id}', [UserController::class, 'getUserById']);
Route::post('updateName', [UserController::class, 'updateName']);
Route::post('updateDesc', [UserController::class, 'updateDescription']);
Route::post('updatePFP', [UserController::class, 'updateProfilePicture']);
Route::post('updateBanner', [UserController::class, 'updateBanner']);
Route::middleware('auth:sanctum')->post('/update-profile', [UserController::class, 'updateProfile']);

Route::middleware('auth:sanctum')->get('/tweet_type/{type}/{page}', [TweetController::class, 'getTweets']);
Route::middleware('auth:sanctum')->get('/user_tweets/{userTag}/{type}/{page}', [TweetController::class, 'getUserTweetsByType']);


Route::middleware('auth:sanctum')->get('/user-tweets/{userTag}', [TweetController::class, 'getUserTweets']);
Route::middleware('auth:sanctum')->get('/liked-tweets/{userTag}', [TweetController::class, 'getUserLikedTweets']);
Route::middleware('auth:sanctum')->get('/commented-tweets/{userTag}', [TweetController::class, 'getUserCommentedTweets']);
Route::middleware('auth:sanctum')->get('/tweetdata/{id}', [TweetController::class, 'getTweetData']);
Route::delete('/tweets/{id}',[TweetController::class, 'deleteTweet']);

Route::get('/comments/{tweetId}', [CommentController::class, 'getCommentsByTweet']);
Route::delete('/delete-comments/{id}',[CommentController::class, 'deleteComment']);

Route::middleware('auth:sanctum')->post('tweets/like', [LikeController::class, 'likeTweet']);
Route::middleware('auth:sanctum')->delete('tweets/unlike/{tweetId}', [LikeController::class, 'unlikeTweet']);

Route::middleware('auth:sanctum')->post('tweets/retweet', [RetweetController::class, 'retweetTweet']);
Route::middleware('auth:sanctum')->delete('tweets/unretweet/{tweetId}', [RetweetController::class, 'unretweetTweet']);

Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->post('/follow/{userId}', [FollowController::class, 'follow']);
Route::middleware('auth:sanctum')->post('/unfollow/{userId}', [FollowController::class, 'unfollow']);
Route::middleware('auth:sanctum')->get('/topFollowedUsers', [FollowController::class, 'topFollowedUsers']);
Route::middleware('auth:sanctum')->get('/allusers', [FollowController::class, 'getAllUsersExceptMe']);
Route::middleware('auth:sanctum')->get('/all-users-mention', [FollowController::class, 'getAllUsersMention']);
Route::get('/countFollowersAndFollowing/{userID}', [FollowController::class, 'countFollowersAndFollowing']);
Route::middleware('auth:sanctum')->get('/following/{tag}', [FollowController::class, 'getFollowingUsers']);
Route::middleware('auth:sanctum')->get('/followers/{tag}', [FollowController::class, 'getFollowers']);

Route::middleware('auth:sanctum')->get('/get-user-tag/{tag}', [UserController::class, 'getUserByTag']);

Route::middleware('auth:sanctum')->post('tweets/bookmark', [BookmarkController::class, 'createBookmark']);
Route::middleware('auth:sanctum')->delete('tweets/unbookmark/{tweetId}', [BookmarkController::class, 'removeBookmark']);

Route::middleware('auth:sanctum')->post('/send-message', [UserController::class, 'sendMessage']);
Route::middleware('auth:sanctum')->get('/user-messages', [UserController::class, 'getUserMessages']);
