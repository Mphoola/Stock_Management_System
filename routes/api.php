<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\SalesController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UsersController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::apiResource('/products', ProductsController::class);
    Route::apiResource('/expenses', ExpensesController::class);
    Route::apiResource('/sales', SalesController::class);

    Route::post('auth/logout', [AuthController::class, 'logoutUser']);
});

Route::get('/unauthorized', function () {
    return response()->json([
        'status' => false,
        'message' => 'Please login to continue',
        'errors' => 'unauthorized'
    ], 401);
})->name('unauthorized');

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
