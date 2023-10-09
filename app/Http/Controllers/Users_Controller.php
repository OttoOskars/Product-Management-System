<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use Carbon\Carbon;

class Users_Controller extends Controller
{

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'UserTag' => 'required|string|unique:users,UserTag',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|string|min:8',
            'DOB' => 'required|date',
            // You can add more validation rules as needed
        ]);

        $dob = Carbon::parse($validatedData['DOB'])->format('Y-m-d');

        if (!str_starts_with($validatedData['UserTag'], '@')) {
            $validatedData['UserTag'] = '@' . $validatedData['UserTag'];
        }

        $existingUsername = users::where('UserTag', $validatedData['UserTag'])->first();
        if ($existingUsername) {
            return response()->json(['message' => 'This username is already taken.'], 400);
        }

        $existingEmail = users::where('Email', $validatedData['Email'])->first();
        if ($existingEmail) {
            return response()->json(['message' => 'This email is already taken.'], 400);
        }

        // Create a new user with the validated data
        $user = users::create([
            'Name' => $validatedData['Name'],
            'UserTag' => $validatedData['UserTag'],
            'Email' => $validatedData['Email'],
            'Password' => bcrypt($validatedData['Password']), // Hash the password for security
            'DOB' => $dob,
            // You can also assign values for other fields here
        ]);

        // Optionally, you can log the user in after registration if your application requires it
        // auth()->login($user);

        // Return a response indicating success
        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    // Other methods for user-related actions can be defined here
}