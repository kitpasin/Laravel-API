<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("users", [UserController::class, "getUsers"]);
Route::get("user/{id}", [UserController::class, "getUserById"]);
Route::post("user", [UserController::class, "createUser"]);
Route::put("user/{id}", [UserController::class, 'updateUser']);
Route::delete("user/{id}", [UserController::class, "deleteUser"]);