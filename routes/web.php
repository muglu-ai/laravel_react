<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return "hello";
});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('api/users', [UserController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('api/user', [UserController::class, 'show']);
    Route::put('api/user/info', [UserController::class, 'updateProfile']);
    Route::put('api/user/password', [UserController::class, 'updatePassword']);
    Route::get('api/user/{id}', [UserController::class, 'show']);

});

//roles
Route::get('api/roles', [RoleController::class, 'index']);
Route::post('api/roles', [RoleController::class, 'store']);
Route::put('api/roles/{id}', [RoleController::class, 'update']);
Route::delete('api/roles/{id}', [RoleController::class, 'destroy']);
Route::get('api/roles/{id}', [RoleController::class, 'show']);


