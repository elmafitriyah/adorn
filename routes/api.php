<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionDetailController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\PurchaseDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/categories', CategoryController::class);
Route::resource('/suppliers', SupplierController::class);
Route::resource('/products', ProductController::class);
Route::resource('/transactions', TransactionController::class);
Route::resource('/transaction_details', TransactionDetailController::class);
Route::resource('/purchases', PurchaseController::class);
Route::resource('/purchase_details', PurchaseDetailController::class);