<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/signup', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/products', [ProductTypeController::class, 'store']);
Route::get('/products', [ProductTypeController::class, 'show']);
Route::get('/productType/{id}', [ProductTypeController::class, 'getProductTypeById']);
Route::post('/product', [ProductTypeController::class, 'update']);
Route::delete('/product_types/{id}', [ProductTypeController::class, 'deleteProductTypeById']);

Route::post('/items', [ItemController::class, 'store']);
Route::get('/items/{product_type_id}', [ItemController::class, 'getItemsByProductType']);
Route::get('/item/{id}', [ItemController::class, 'getItemById']);
Route::post('/updateItem', [ItemController::class, 'update']);
Route::delete('/deleteItem/{id}', [ItemController::class, 'deleteItemById']);
Route::post('/setItemToSold', [ItemController::class, 'setIsSold']);
Route::post('/setItemToNotSold', [ItemController::class, 'setIsNotSold']);
