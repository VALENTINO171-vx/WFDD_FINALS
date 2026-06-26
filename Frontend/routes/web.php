<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('login');
});

// Authentication Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

// Protected Routes - Require Authentication
Route::middleware(App\Http\Middleware\AuthenticateMiddleware::class)->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/restaurant/{id}', [App\Http\Controllers\RestaurantController::class, 'details'])->name('restaurant.details');
    Route::post('/restaurant/{id}/reviews', [App\Http\Controllers\RestaurantController::class, 'submitReview'])->name('restaurant.reviews.submit');

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

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard.alt');
        Route::get('/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

        // Restaurant Management Routes
        Route::get('/restaurants/create', [App\Http\Controllers\RestaurantController::class, 'create'])->name('restaurants.create');
        Route::post('/restaurants', [App\Http\Controllers\RestaurantController::class, 'store'])->name('restaurants.store');
        Route::get('/restaurants/{id}/edit', [App\Http\Controllers\RestaurantController::class, 'edit'])->name('restaurants.edit');
        Route::put('/restaurants/{id}', [App\Http\Controllers\RestaurantController::class, 'update'])->name('restaurants.update');
        Route::get('/restaurants/{id}', [App\Http\Controllers\RestaurantController::class, 'show'])->name('restaurants.show');
        Route::delete('/restaurants/{id}', [App\Http\Controllers\RestaurantController::class, 'destroy'])->name('restaurants.destroy');

        // User Management Routes (Admin)
        Route::post('/users/{id}/toggle-blacklist', [App\Http\Controllers\UserController::class, 'toggleBlacklist'])->name('users.toggle-blacklist');
        Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroyAdmin'])->name('users.destroy');
    });
});