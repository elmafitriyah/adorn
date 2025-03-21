<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Models\Product;
use App\Models\Supplier;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test', function() {
    return view('test');
});

Route::get('/supplier', function() {
    return view('supplier');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id_category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id_category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id_Category}', [CategoryController::class, 'destroy'])->name('categories.destory');

Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/{id_supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::put('/suppliers/{id_supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/{id_supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id_product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id_product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id_product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/purchases/{id_purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
Route::put('/purchases/{id_purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::delete('/purchases/{id_purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');

Route::get('/purchase_details', [PurchaseDetailController::class, 'index'])->name('purchase_details.index');
Route::get('/purchase_details/create', [PurchaseDetailController::class, 'create'])->name('purchase_details.create');
Route::post('/purchase_details', [PurchaseDetailController::class, 'store'])->name('purchase_details.store');
Route::get('/purchase_details/{id_purchase}/edit', [PurchaseDetailController::class, 'edit'])->name('purchase_details.edit');
Route::put('/purchase_details/{id_purchase}', [PurchaseDetailController::class, 'update'])->name('purchase_details.update');
Route::delete('/purchase_details/{id_purchase}', [PurchaseDetailController::class, 'destroy'])->name('purchase_details.destroy');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{id_transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{id_transaction}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{id_transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

Route::get('/transaction_details', [TransactionDetailController::class, 'index'])->name('transaction_details.index');
Route::get('/transaction_details/create', [TransactionDetailController::class, 'create'])->name('transaction_details.create');
Route::post('/transaction_details', [TransactionDetailController::class, 'store'])->name('transaction_details.store');
Route::get('/transaction_details/{id_transaction_detail}/edit', [TransactionDetailController::class, 'edit'])->name('transaction_details.edit');
Route::put('/transaction_details/{id_transaction_detail}', [TransactionDetailController::class, 'update'])->name('transaction_details.update');
Route::delete('/transaction_details/{id_transaction_detail}', [TransactionDetailController::class, 'destroy'])->name('transaction_details.destroy');

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
