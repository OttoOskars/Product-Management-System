<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\AuthController;

Route::post('check-email', [UserController::class, 'checkEmail']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Use GET for fetching user information, and protect it with the auth:sanctum middleware
Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getUser']);
Route::middleware('auth:sanctum')->post('tweets', [TweetController::class, 'createTweet']);
Route::middleware('auth:sanctum')->post('/create-comments', [CommentController::class, 'createComment']);

Route::get('/get-user/{id}', [UserController::class, 'getUserById']);
Route::post('updateName', [UserController::class, 'updateName']);
Route::post('updateDesc', [UserController::class, 'updateDescription']);
Route::post('updatePFP', [UserController::class, 'updateProfilePicture']);
Route::post('updateBanner', [UserController::class, 'updateBanner']);

Route::middleware('auth:sanctum')->get('/all-tweets', [TweetController::class, 'getAllTweets']);
Route::get('/tweet/{id}', [TweetController::class, 'getTweetData']);
Route::delete('/tweets/{id}',[TweetController::class, 'deleteTweet']);

Route::get('/comments/{tweetId}', [CommentController::class, 'getCommentsByTweet']);
Route::delete('/delete-comments/{id}',[CommentController::class, 'deleteComment']);

Route::middleware('auth:sanctum')->post('tweets/like', [LikeController::class, 'likeTweet']);
Route::middleware('auth:sanctum')->delete('tweets/unlike/{tweetId}', [LikeController::class, 'unlikeTweet']);

Route::post('reset-password', [AuthController::class, 'resetPassword']);

