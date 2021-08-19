<?php

use App\Http\Controllers\Ecommerce\ProductController;
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

Route::post('/product', [ProductController::class, 'store'])->name('api.product.store');
Route::post('/product/{id}', [ProductController::class, 'delete'])->name('api.product.destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
