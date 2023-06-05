<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json([
                "status" => 404,
                "message" => "No users found."
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "users" => $users
        ], 200);
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                "status" => 200,
                "user" => $user
            ], 200);
        }
        return response()->json([
            "status" => 404,
            "message" => "User id $id not found."
        ], 404);
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "errors" => $validator->messages()
            ], 422);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);

        if ($user) {
            return response()->json([
                "status" => 200,
                "message" => "User created successfully."
            ], 200);
        }

        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    public function updateUser(Request $request, $id) 
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "Status" => 404,
                "message" => "User not found."
            ], 404);
        }

        $user->update($request->all());

        return response()->json([
            "status" => 200,
            "user" => $user
        ], 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "Status" => 404,
                "message" => "User not found."
            ], 404);
        }

        $user->delete();

        return response()->json([
            "status" => 200,
            "message" => "User deleted successfully."
        ], 200);
    }
}
