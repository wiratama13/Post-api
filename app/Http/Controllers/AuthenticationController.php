<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['the provided credentials are incorrect'],
            ]);
        }

        $token = $user->createToken('login token')->plainTextToken;

        $response = [
            "success" => true,
            "user" => $user,
            "token" => $token
        ];

        return response($response, 200);
    }

    // public function logout(Request $request) 
    // {
    //     $request->user()->currentAccessToken()->delete();
    // }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logout sukses'
        ]);
    }

    public function person()
    {
        return response()->json([
            Auth::user()
        ]);
    }
}
