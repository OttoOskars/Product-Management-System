<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
       /*  return auth()->user(); */
       return Auth::user();
    }

    public function updateName(Request $request)
    {
        $user = auth()->user();
        $newName = $request->Name;

        if ($newName) {
            $user->Name = $newName;
            $user->save();
            $success = true;
            $message = 'Name updated successfully';

        } else {
            $success = false;
            $message = 'Name cannot be empty';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function updateDescription(Request $request)
    {
        $user = auth()->user();
        $newDescription = $request->Description;

        if ($newDescription) {
            $user->description = $newDescription;
            $user->save();
            $success = true;
            $message = 'Description updated successfully';

        } else {
            $success = false;
            $message = 'Description cannot be empty';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
    
    public function updateProfilePicture(Request $request)
    {
        if ($request->hasFile('profile_picture')) {
            $ProfilePicture = $request->file('profile_picture');
            $fileName = time() . '_' . $ProfilePicture->getClientOriginalName();
            $path = $ProfilePicture->storeAs('profile_pictures', $fileName, 'public');

            if (auth()->user()->ProfilePicture) {
                Storage::delete('/public/' . auth()->user()->ProfilePicture);
            }

            auth()->user()->ProfilePicture = $path;
            auth()->user()->save();
            $success = true;
            $message = 'Profile picture uploaded successfully';
        } else {
            $success = false;
            $message = 'Please select a valid image file.';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
    public function updateBanner(Request $request)
    {
        if ($request->hasFile('banner_picture')) {
            $BannerPicture = $request->file('banner_picture');
            $fileName = time() . '_' . $BannerPicture->getClientOriginalName();
            $path = $Banner->storeAs('banner_pictures', $fileName, 'public');

            if (auth()->user()->Banner) {
                Storage::delete('/public/' . auth()->user()->Banner);
            }

            auth()->user()->Banner = $path;
            auth()->user()->save();
            $success = true;
            $message = 'Banner picture uploaded successfully';
        } else {
            $success = false;
            $message = 'Please select a valid image file.';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
