<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

// Authentication Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

// User Management Routes
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

Route::get('/feed', function () {
    return view('feed');
});