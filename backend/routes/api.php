<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::apiResource('coaches', CoachController::class)->only(['index', 'show']);
Route::apiResource('plans', PlanController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('locations', LocationController::class)->only(['index', 'show']);
Route::post('/contact', [ContactController::class, 'store']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // User specific routes
    Route::post('/subscriptions', [PlanController::class, 'subscribe']);
    Route::apiResource('orders', OrderController::class)->except(['destroy']);
});