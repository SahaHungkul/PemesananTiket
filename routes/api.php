<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Register Route
Route::post('/register', [RegisterController::class, 'register']);
//Login Route
Route::post('/login', [LoginController::class, 'login']);
