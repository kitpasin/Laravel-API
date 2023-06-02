<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();

        return view("welcome", [
            "users" => $users
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
    }
}
