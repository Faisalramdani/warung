<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::post( 'invoice' ,[OrderController::class,'show'])->name('invoice');
    Route::post( 'coupon' ,[OrderController::class,'coupon'])->name('coupon');

    Route::resource('journal', JournalController::class);
    Route::get('report/journal',[JournalController::class,'Journal'])->name('report-journal');
    Route::post( '/print/journal' ,[JournalController::class,'showJurnal'])->name('print-journal');
    Route::post( 'journal' ,[JournalController::class,'show'])->name('journal');


    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);


    Route::get('/lapjur', 'JurnalController@index')->name('lapjur');
    Route::resource( '/stok' , 'LapStokController');

});

// Route::prefix('pemilik')->middleware('auth')->group(function () {
//     Route::get('/', [HomeController::class, 'index'])->name('home');
//     Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
//     Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
//     Route::resource('products', ProductController::class);
//     Route::resource('customers', CustomerController::class);
//     Route::resource('orders', OrderController::class);

//     Route::resource('journal', JournalController::class);
//     Route::post( 'journal' ,[JournalController::class,'show'])->name('journal');

//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
//     Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
//     Route::delete('/cart/delete', [CartController::class, 'delete']);
//     Route::delete('/cart/empty', [CartController::class, 'empty']);


//     Route::get('/lapjur', 'JurnalController@index')->name('lapjur');
//     Route::resource( '/stok' , 'LapStokController');

// });
