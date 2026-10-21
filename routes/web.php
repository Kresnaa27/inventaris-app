<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BorrowController;

Route::get('/', function () {
    return view('welcome');
});
// Route untuk melihat katalog barang
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');
Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');
Route::get('/borrow/history', [BorrowController::class, 'history'])->name('borrow.history');