<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\UserRoles;
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
            "role_id" => $request->role_id
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

    public function getRoles(): JsonResponse
    {
        $roles = UserRoles::orderBy('created_at', 'desc')->get();
        return response()->json($roles, 200);
    }

    public function getUsers(): JsonResponse
    {
        $users = User::orderBy('created_at', 'asc')->get();
        $userInfo = array();

        foreach ($users as $user) {
            $info = array(
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role_id,
            );

            $role = UserRoles::find($user->role_id);
            $info['role'] = $role ? $role->role : null;

            array_push($userInfo, $info);
        }

        return response()->json($userInfo, 200);
    }

    public function deleteUser(Request $request): JsonResponse
    {
        $userId = $request->userId;

        if(User::where('id', $userId)->exists()) {
            $user = User::find($userId);
            $user->delete();

            return response()->json([
                "success" => "User deleted successfully"
            ],200);
        }

        return response()->json([
            "message" => "Product not found"
        ],404);
    }

    public function detailsUser(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

        if(!empty($user)) {
            return response()->json($user);
        }

        return response()->json([
            "message" => "User not found"
        ],404);
    }

    public function updateUser(Request $request, $id): JsonResponse
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);

            $user->update($request->all());

            return response()->json([
                "data" => $user,
                "message" => "User updated successfully"
            ], 200);
        }
    }
}
