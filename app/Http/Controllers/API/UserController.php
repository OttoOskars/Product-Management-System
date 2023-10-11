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
                Auth::login($user);
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
            'user' => $user
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
            } else {
                $existingEmail = User::where('Email', strtolower($request->Email))->first();
                if ($existingEmail) {
                    $success = false;
                    $message = 'Email is already taken.';
                } else {
                    $user = new User();
                    $user->Name = $request->Name;

                    $correctTag = '@' . ltrim($request->UserTag, '@');
                    $user->UserTag = $correctTag;
                    $user->Email =strtolower($request->Email);
                    $user->Password = Hash::make($request->Password);
    
                    $dob = Carbon::parse($request->DOB)->format('Y-m-d');
                    $user->DOB = $dob;
                    $user->save();
    
                    $success = true;
                    $message = 'User created successfully';
                    Auth::loginUsingId($user->id);
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
            Auth::logout();
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

}
