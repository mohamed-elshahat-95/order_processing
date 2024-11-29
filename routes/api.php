<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductsController;

// Authentication Routes
Route::post('register', [AuthController::class, 'register']); // User Registration
Route::post('login', [AuthController::class, 'login']); // User Login
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']); // User Logout

// User CRUD Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'index']); // Get all users
    Route::get('users/{id}', [UserController::class, 'show']); // Get user by ID
    Route::post('users', [UserController::class, 'store']); // Create user
    Route::put('users/{user}', [UserController::class, 'update']); // Update user
    Route::delete('users/{id}', [UserController::class, 'destroy']); // Delete user
});

// Product CRUD Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('products', [ProductsController::class, 'index']); // Get all products
    Route::get('products/{id}', [ProductsController::class, 'show']); // Get product by ID
    Route::post('products', [ProductsController::class, 'store']); // Create product
    Route::put('products/{product}', [ProductsController::class, 'update']); // Update product
    Route::delete('products/{id}', [ProductsController::class, 'destroy']); // Delete product
});