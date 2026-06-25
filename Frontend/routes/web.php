<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'getUsers']);

Route::get('/feed', function () {
    return view('feed');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);