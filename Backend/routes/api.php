<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

//get users for login
Route::get('/users', [App\Http\Controllers\API\v1\UserController::class, 'getUsers']);

//get specific user for auth
Route::get('/users/{user_name}', [App\Http\Controllers\API\v1\UserController::class, 'getUser']);

// toggle blacklist status
Route::post('/users/{id}/toggle-blacklist', [App\Http\Controllers\API\v1\UserController::class, 'toggleBlacklist']);

//get restaurant
Route::get('/restaurants',[App\Http\Controllers\API\v1\RestaurantController::class, 'getRestaurants']);
Route::get('/restaurants/{id}',[App\Http\Controllers\API\v1\RestaurantController::class, 'getRestaurant']);

// restaurant reviews
Route::post('/restaurants/{id}/reviews',[App\Http\Controllers\API\v1\ReviewController::class,'store']);
Route::put('/reviews/{id}', [App\Http\Controllers\API\v1\ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [App\Http\Controllers\API\v1\ReviewController::class, 'destroy']);