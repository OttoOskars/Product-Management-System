<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UserController extends Controller
{
    public function checkEmail(Request $request)
    {
        $user = User::where('Email', $request->Email)->first();
        if ($user) {
            $success = true;
            $message = 'Email is registered.';
        } else {
            $success = false;
            $message = 'Email not found.';
        }
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $credentials = [
            'Email' => $request->Email,
            'Password' => $request->Password
        ];

        $user = User::where('Email', $request->Email)->first();

        if ($user) {
            // Check the password
            if (Hash::check($request->Password, $user->Password)) {
                $token = $user->createToken('authToken')->plainTextToken; // Create and get the user token
                $user->token = $token;

                $success = true;
                $message = 'User logged in successfully';
            } else {
                $success = false;
                $message = 'Login failed. Invalid password.';
            }
        } else {
            $success = false;
            $message = "Email isn't registered.";
        }
        $response = [
            'success' => $success,
            'message' => $message,
            'user' => $user,
        ];
        return response()->json($response);
    }

    public function register(Request $request)
    {
        try {
            $existingUserTag = User::where('UserTag', '@' . $request->UserTag)->first();
            if ($existingUserTag) {
                $success = false;
                $message = 'Username is already taken.';
                $user= null;
            } else {
                $existingEmail = User::where('Email', strtolower($request->Email))->first();
                if ($existingEmail) {
                    $success = false;
                    $message = 'Email is already taken.';
                    $user= null;
                } else {
                    $user = new User();
                    $user->Name = $request->Name;

                    $correctTag = '@' . ltrim($request->UserTag, '@');
                    $user->UserTag = $correctTag;
                    $user->Email = strtolower($request->Email);
                    $user->Password = Hash::make($request->Password);
                    $user->ProfilePicture = 'profile_pictures/DefaultPFP.jpeg';

                    $dob = Carbon::parse($request->DOB)->format('Y-m-d');
                    $user->DOB = $dob;
                    $user->save();

                    $success = true;
                    $message = 'User created successfully';
                    $token = $user->createToken('authToken')->plainTextToken; // Create and get the user token
                    $user->token = $token;
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = 'An error occurred while creating the user.';
        }

        $response = [
            'success' => $success,
            'message' => $message,
            'user' => $user
        ];
        return response()->json($response);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete(); // Revoke user tokens
            $success = true;
            $message = 'User logged out successfully';
        } catch (\Exception $ex) {
            $success = false;
            $message = 'An error occurred while logging out.';
        }
        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }
    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $userData = [
            'UserID' => $user->UserID,
            'Name' => $user->Name,
            'UserTag' => $user->UserTag,
        ];

        return response()->json(['user' => $userData]);
    }

    public function getUserByTag($tag)
    {
        $tag = '@' . ltrim($tag, '@');
        $user = User::where('UserTag', $tag)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->create_date =  'Joined ' . $user->created_at->format('F Y');
        $user->follower_count = $user->followers()->count();
        $user->following_count = $user->following()->count();

        $user->isFollowedByMe = $this->checkIfFollowedByUser(auth()->user(), $user);

        return response()->json(['user' => $user]);
    }
    private function checkIfFollowedByUser($user1, $user2)
    {
        return $user2->followers->contains('UserID', $user1->UserID);
    }

    public function getUser()
    {
       return Auth::user();
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $newName = $request->input('Name');
        $newDescription = $request->input('Description');
        $newProfilePicture = $request->file('profile_picture');
        $newBannerPicture = $request->file('banner_picture');

        $success = true;
        $messages = [];

        if ($newName) {
            $user->Name = $newName;
            $messages[] = 'Name updated successfully';
        } else {
            $success = false;
            $messages[] = 'Name cannot be empty';
        }

        if ($newDescription) {
            $user->description = $newDescription;
            $messages[] = 'Description updated successfully';
        } else {
            $user->description = '';
        }

        if ($newProfilePicture) {
            $image = $request->file('profile_picture');
            $path = $image->store('profile_pictures', 'public');
            if ($user->ProfilePicture) {
                $imagePath = public_path('storage/' . $user->ProfilePicture);
    
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                    Log::info('Image deleted: ' . $imagePath); // Log the image deletion
                } else {
                    Log::info('Image not found: ' . $imagePath); // Log if the image was not found
                }
            }
            $user->ProfilePicture = $path;
            $messages[] = 'Profile picture uploaded successfully';
        }
        if ($newBannerPicture) {
            $image = $request->file('banner_picture');
            $path = $image->store('banner_pictures', 'public');
            if ($user->Banner) {
                $imagePath = public_path('storage/' . $user->Banner);
    
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                    Log::info('Image deleted: ' . $imagePath); // Log the image deletion
                } else {
                    Log::info('Image not found: ' . $imagePath); // Log if the image was not found
                }
            }
            $user->Banner = $path;
            $messages[] = 'Banner uploaded successfully';
        }
        if (!$success) {
            $messages[] = 'Please select a valid image file.';
        }

        $user->save();

        $response = [
            'success' => $success,
            'messages' => $messages,
        ];

        return response()->json($response);
    }
}
