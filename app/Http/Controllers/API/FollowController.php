<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($userToFollowId)
    {
        $user = auth()->user();
        $userToFollow = User::find($userToFollowId);
    
        if ($userToFollow) {
            // Attach the relationship
            $user->follows()->attach($userToFollow->UserID);
            return response()->json(['message' => 'You are now following this user.'.$userToFollow->UserID]);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
    
    public function unfollow($userToUnfollowId)
    {
        $user = auth()->user();
        $userToUnfollow = User::find($userToUnfollowId);
    
        if ($userToUnfollow) {
            // Detach the relationship
            $user->follows()->detach($userToUnfollow->UserID);
            return response()->json(['message' => 'You have unfollowed this user.']);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
    public function topFollowedUsers()
    {
        if (auth()->check()) {
            $user1 = auth()->user();
            $topFollowedUsers = User::withCount('followers')
                ->where('UserID', '!=', $user1->UserID) // Exclude the authenticated user
                ->orderBy('followers_count', 'desc')
                ->take(3)
                ->get();
    
            foreach ($topFollowedUsers as $user2) {
                $user2->isFollowedByMe = $this->checkIfFollowedByUser($user1, $user2);
                $user2->isFollowingMe = $this->checkIfFollowedByUser($user2, $user1);
            }
    
            return response()->json($topFollowedUsers);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }
    public function getAllUsers()
    {
        if (auth()->check()) {
            $user1 = auth()->user();
            $Users = User::withCount('followers')
                ->where('UserID', '!=', $user1->UserID) // Exclude the authenticated user
                ->orderBy('followers_count', 'desc')
                ->get();
    
            foreach ($Users as $user2) {
                $user2->isFollowedByMe = $this->checkIfFollowedByUser($user1, $user2);
            }
    
            return response()->json($Users);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }
    public function countFollowersAndFollowing($userID)
    {
        $user = User::find($userID);

        if ($user) {
            $followersCount = $user->followers()->count();
            $followingCount = $user->following()->count();

            return response()->json([
                'followers_count' => $followersCount,
                'following_count' => $followingCount,
            ]);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    private function checkIfFollowedByUser($user1, $user2)
    {
        return $user2->followers->contains('UserID', $user1->UserID);
    }

    public function getFollowingUsers($userTag)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tag = '@' . ltrim($userTag, '@');
            $user2 = User::where('UserTag', $tag)->first();
            if (!$user2) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $userID = $user2->UserID;
            $following = User::select('users.*')
                ->join('follows', 'users.UserID', '=', 'follows.FollowingID')
                ->where('follows.FollowerID', $user->UserID)
                ->get();
            foreach ($following as $user3) {
                $user3->isFollowedByMe = $this->checkIfFollowedByUser($user, $user3);
            }
            return response()->json($following);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }

    public function getFollowers($userTag)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tag = '@' . ltrim($userTag, '@');
            $user2 = User::where('UserTag', $tag)->first();
            if (!$user2) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $userID = $user2->UserID;
            $followers = User::select('users.*')
                ->join('follows', 'users.UserID', '=', 'follows.FollowerID')
                ->where('follows.FollowingID', $user2->UserID)
                ->get();
            foreach ($followers as $user3) {
                $user3->isFollowedByMe = $this->checkIfFollowedByUser($user, $user3);
            }
            return response()->json($followers);
        } else {
            // Handle the case where the user is not authenticated.
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    }
}