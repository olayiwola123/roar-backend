<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::name('api.')->group(function() {
    Route::post('login', [AdminController::class, 'adminLogin']);
    Route::post('logout', [AdminController::class, 'logout']);



// Route to list all products
Route::get('/products', [ProductController::class, 'index']);

// Route to create a new product
Route::post('/products-store', [ProductController::class, 'store']);

// Route to display a specific product
Route::get('/products/{id}', [ProductController::class, 'show']);

// Route to update an existing product
Route::put('/products/{id}', [ProductController::class, 'update']);

// Route to delete a specific product
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});