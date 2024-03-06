<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            "email" => "required | email",
            "password" => "required"
        ]);

        $user = User::where("email", $request->email)->first();
        if(!empty($user)) {

            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("loginToken")->plainTextToken;

                return response()->json([
                    "message" => "Login successful",
                    "token" => $token,
                    "roleId" => $user->role_id
                ],200);
            }

            return response()->json([
                "message" => "Passwords didn't match"
            ],404);
        }

        return response()->json([
            "message" => "Invalid login details"
        ],404);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            "name" => "required",
            "email" => "required | email | unique:users",
            "password" => "required | confirmed",
            "role" => "required"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role_id" => $request->role
        ]);

        return response()->json([
            "message" => "User registered succesfully"
        ],200);
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "user logged out"
        ],404);
    }
}
