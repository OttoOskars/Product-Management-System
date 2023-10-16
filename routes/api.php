<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::post('check-email', [UserController::class, 'checkEmail']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Use GET for fetching user information, and protect it with the auth:sanctum middleware
Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getUser']);


Route::post('updateName', [UserController::class, 'updateName']);
Route::post('updateDesc', [UserController::class, 'updateDescription']);
Route::post('updatePFP', [UserController::class, 'updateProfilePicture']);
Route::post('updateBanner', [UserController::class, 'updateBanner']);
