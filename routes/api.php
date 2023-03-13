<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/category')->group(function() {
    Route::get('list-category-product', [CategoryController::class, 'listCategoryWithProduct']);
    Route::get('list-all', [CategoryController::class, 'listAllCategory']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::get('show/{id}', [CategoryController::class, 'show']);
    Route::put('update/{id}', [CategoryController::class, 'update']);
    Route::delete('delete/{id}', [CategoryController::class, 'destroy']);
});

Route::prefix('/product')->group(function() {
    Route::get('list', [ProductController::class, 'list']);
    Route::get('list-all', [ProductController::class, 'listAll']);
    Route::post('store', [ProductController::class, 'store']);
    Route::get('show/{id}', [ProductController::class, 'show']);
    Route::put('update/{id}', [ProductController::class, 'update']);
    Route::delete('delete/{id}', [ProductController::class, 'destroy']);
});

Route::any('{path}', function() {
    return response()->json([
        'message' => 'Route not found',
    ], 404);
})->where('path', '.*');