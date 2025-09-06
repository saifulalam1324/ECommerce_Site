<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;


// Customer
Route::controller(UserController::class)->group(function () {
    Route::get('/', 'HOME')->name('home');
    Route::get('/login', 'LOGINSIGNUP')->name('LoginSignup');
    Route::get('/product/{id}', 'SHOWEACHPRODUCT')->name('Each Product');
});


//Admin
Route::get('/adminloginpage', [AdminController::class, 'ADMINLOGINPAGE'])
    ->name('AdminLoginPage');
Route::get('/adminsignuppage', [AdminController::class, 'ADMINSIGNUPPAGE'])
    ->name('AdminSignupPage');
Route::post('/adminregister', [AdminController::class, 'ADMINSIGNUP'])
    ->name('AdminSignup');
Route::post('/adminlogin', [AdminController::class, 'ADMINLOGIN'])
    ->name('AdminLogin');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'ADMINHOME'])->name('Admin home');
    Route::get('/allusers', [AdminController::class, 'READUSERS'])->name('All users');
    Route::get('/allvendors', [AdminController::class, 'READVENDORS'])->name('All vendors');
    Route::get('/vendoreach/{id}', [AdminController::class, 'READVENDORS1'])->name('Each vendors');
    Route::post('/adminlogout', [AdminController::class, 'ADMINLOGOUT'])->name('AdminLogout');
    Route::get('/adminprofile', [AdminController::class, 'ADMINPROFILE'])->name('AdminProfile');
});

// Vendor
Route::controller(VendorController::class)->group(function () {
    Route::get('/vendor', 'VENDORHOME')->name('Vendor home');
    Route::get('/addproduct', 'ADDPRODUCT')->name('Add product');
    Route::post('/storeproduct', 'STOREPRODUCT')->name('Store product');
});
