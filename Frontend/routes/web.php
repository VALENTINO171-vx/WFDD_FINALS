<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::middleware('auth')->group(function(){

});
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticateUser'])->name('login.authenticate');

Route::get('/feed', function () {
    return view('feed');
});