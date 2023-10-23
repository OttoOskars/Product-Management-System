<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function resetPassword(Request $request)
    {
        // Validate the input data (email and new password)
        $request->validate([
            'email' => 'required|email',
            'newPassword' => 'required|min:8',
        ]);

        $email = $request->input('email');
        $newPassword = $request->input('newPassword');

        // Find the user by their email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Hash the new password securely
        $hashedPassword = Hash::make($newPassword);

        // Update the user's password in the database
        $user->password = $hashedPassword;
        $user->save();

        return response()->json(['message' => 'Password reset successful']);
    }
}