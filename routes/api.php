<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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
Route::post('/Product/Create', [ProductController::class, 'Create']);
Route::get('/Product/List', [ProductController::class, 'List_product']);
Route::post('/Product/Edit/{id}', [ProductController::class, 'Update']);
Route::delete('Product/delete/{id}', [ProductController::class, 'Delete']);

