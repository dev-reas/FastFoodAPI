<?php

use App\Http\Controllers\AddOnsController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', [SessionController::class, 'show']);

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/food/{food}', [FoodController::class, 'show']);

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [SessionController::class, 'store']);
Route::middleware('auth:sanctum')->post('/logout', [SessionController::class, 'destroy']);

Route::middleware('auth:sanctum')->post('/orders/create', [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->get('/orders', [OrderController::class, 'index']);
Route::middleware('auth:sanctum')->get('/orders/ongoing', [OrderController::class, 'ongoingOrders']);
Route::middleware('auth:sanctum')->get('/orders/history', [OrderController::class, 'orderHistory']);
Route::middleware('auth:sanctum')->get('/orders/latest', [OrderController::class, 'latestOrder']);
Route::middleware('auth:sanctum')->patch('/orders/{order}', [OrderController::class, 'update']);

Route::middleware('auth:sanctum')->get('/addons', [AddOnsController::class, 'index']);
Route::middleware('auth:sanctum')->get('/addons/{addons}', [AddOnsController::class, 'show']);
