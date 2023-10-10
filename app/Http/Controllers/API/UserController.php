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
    public function login(Request $request)
    {
        $credentials = [
            'Email' => $request->Email,
            'Password' => $request->Password
        ];

        $user = User::where('Email', $request->Email)->first();

        if ($user && Hash::check($request->Password, $user->Password)) {
            $success = true;
            $message = 'User logged in successfully';
        } else {
            $success = false;
            $message = 'Login failed. Invalid credentials.';
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }

    public function register(Request $request)
    {
        try {
            // Check if UserTag is already taken
            $existingUserTag = User::where('UserTag', '@' . $request->UserTag)->first();
            if ($existingUserTag) {
                $success = false;
                $message = 'Username is already taken.';
            } else {
                // Check if Email is already taken
                $existingEmail = User::where('Email', $request->Email)->first();
                if ($existingEmail) {
                    $success = false;
                    $message = 'Email is already taken.';
                } else {
                    // Create a new user
                    $user = new User();
                    $user->Name = $request->Name;

                    $correctTag = '@' . ltrim($request->UserTag, '@');
                    $user->UserTag = $correctTag;
                    $user->Email = $request->Email;
                    $user->Password = $request->Password;
    
                    $dob = Carbon::parse($request->DOB)->format('Y-m-d');
                    $user->DOB = $dob;
                    $user->save();
    
                    $success = true;
                    $message = 'User created successfully';
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = 'An error occurred while creating the user.';
        }
    
        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }
    public function logout(Request $request)
    {
        try {
            Session::flush();
            $success = true;
            $message = 'User logged out successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }

}
