<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/posts", [PostApiController::class, 'index']);

Route::get("/products", [\App\Http\Controllers\ProductsController::class, 'index']);
Route::get("/products/{id}", [\App\Http\Controllers\ProductsController::class, 'show']);
Route::post("/products", [\App\Http\Controllers\ProductsController::class, 'store']);
Route::put("/products/{id}", [\App\Http\Controllers\ProductsController::class, 'update']);
Route::delete("/products/{id}", [\App\Http\Controllers\ProductsController::class, 'delete']);

Route::get("/orders", [\App\Http\Controllers\OrdersController::class, 'index']);
Route::get("/orders/{id}", [\App\Http\Controllers\OrdersController::class, 'show']);
Route::get("/place_order", [\App\Http\Controllers\OrdersController::class, 'store']);
Route::post("/place_order", [\App\Http\Controllers\OrdersController::class, 'placeOrder'])->name('place_order');

Route::get("/print_sheet", [\App\Http\Controllers\PrintSheetController::class, 'index']);
Route::get("/print_sheet/{id}", [\App\Http\Controllers\PrintSheetController::class, 'show']);
