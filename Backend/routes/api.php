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
Route::get('/restaurants/search',[App\Http\Controllers\API\v1\RestaurantController::class, 'search']);
Route::post('/restaurants', [App\Http\Controllers\API\v1\RestaurantController::class, 'store']);
Route::put('/restaurants/{id}', [App\Http\Controllers\API\v1\RestaurantController::class, 'update']);
Route::delete('/restaurants/{id}', [App\Http\Controllers\API\v1\RestaurantController::class, 'destroy']);

// restaurant menu management
Route::post('/restaurants/{id}/menus', [App\Http\Controllers\API\v1\MenuController::class, 'store']);
Route::put('/menus/{id}', [App\Http\Controllers\API\v1\MenuController::class, 'update']);
Route::delete('/menus/{id}', [App\Http\Controllers\API\v1\MenuController::class, 'destroy']);

// restaurant reviews
Route::post('/restaurants/{id}/reviews',[App\Http\Controllers\API\v1\ReviewController::class,'store']);
Route::put('/reviews/{id}', [App\Http\Controllers\API\v1\ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [App\Http\Controllers\API\v1\ReviewController::class, 'destroy']);