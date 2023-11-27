<?php

use App\Http\Controllers\CategoryController;
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
// insert delete and Update
Route::get('/List-Category', [CategoryController::class, 'List_Category']);
Route::post('/Category/Create', [CategoryController::class, 'Create']);
Route::delete('/categories/delete/{id}', [CategoryController::class, 'Delete']);
Route::post('/categories/update/{id}', [CategoryController::class, 'Update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
