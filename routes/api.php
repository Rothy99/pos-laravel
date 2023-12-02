<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SpecificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route crud for Category
Route::get('/List-Category', [CategoryController::class, 'List_Category']);
Route::post('/Category/Create', [CategoryController::class, 'Create']);
Route::delete('/Category/Delete/{id}', [CategoryController::class, 'Delete']);
Route::post('/Category/Update/{id}', [CategoryController::class, 'Update']);

// Route crud for Purchase
Route::get('/List-Purchase', [PurchaseController::class, 'List_Purchase']);
Route::post('/Purchase/Add', [PurchaseController::class, 'Create']);
Route::delete('/Purchase/Delete/{id}', [PurchaseController::class, 'Delete']);
Route::post('/Purchase/Update/{id}', [PurchaseController::class, 'Update']);

// Route crud for Specification
Route::get('/List_Specification', [SpecificationController::class, 'List_Specification']);
Route::post('/Specification/Create', [SpecificationController::class, 'Create']);
Route::delete('Specification/Delete/{id}', [SpecificationController::class, 'Delete']);
Route::post('Specification/Update/{id}', [SpecificationController::class, 'Update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/Product/Create', [ProductController::class, 'Create']);
Route::get('/Product/List', [ProductController::class, 'List_product']);
Route::post('/Product/Edit/{id}', [ProductController::class, 'Update']);
Route::delete('Product/delete/{id}', [ProductController::class, 'Delete']);

Route::post('/Cart/{id}', [CartController::class, 'addToCart']);
Route::get('/Cart', [CartController::class, 'showCart']);
Route::delete('/cart/clear', [CartController::class, 'clearCart']);
Route::patch('update/cart/{id}', [CartController::class, 'updateQuantity']);
