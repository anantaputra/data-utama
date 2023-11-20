<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/product/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/product/view/{id}', [ProductController::class, 'view'])->name('product.view');
Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/store-edit', [ProductController::class, 'store_edit'])->name('product.store-edit');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/transaction', [TransactionController::class, 'index'])->middleware('auth')->name('transaction');
Route::post('/transaction/search', [TransactionController::class, 'search'])->middleware('auth')->name('transaction.search');

require __DIR__.'/auth.php';
