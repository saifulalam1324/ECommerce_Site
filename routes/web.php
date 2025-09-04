<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'HOME')->name('home');
    Route::get('/login', 'LOGINSIGNUP')->name('LoginSignup');
    Route::get('/product/{id}','SHOWEACHPRODUCT')->name('Each Product');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'ADMINHOME')->name('Admin home');
    Route::get('/allusers', 'READUSERS')->name('All users');
    Route::get('/allvendors', 'READVENDORS')->name('All vendors');
    Route::get('/vendoreach/{id}', 'READVENDORS1')->name('Each vendors');
});

Route::controller(VendorController::class)->group(function () {
    Route::get('/vendor', 'VENDORHOME')->name('Vendor home');
    Route::get('/addproduct', 'ADDPRODUCT')->name('Add product');
    Route::post('/storeproduct', 'STOREPRODUCT')->name('Store product');
});
