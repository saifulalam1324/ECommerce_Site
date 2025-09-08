<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Models\Vendor;

Route::post('/usersignup', [CustomerController::class, 'USERSIGNUP'])
    ->name('UserSignup');
Route::post('/userlogin', [CustomerController::class, 'USERLOGIN'])
    ->name('UserLogin');
    Route::get('/login', [CustomerController::class,'LOGINSIGNUP'])->name('LoginSignup');
Route::middleware(['customer'])->group(function () {
    Route::get('/', [CustomerController::class, 'HOME'])->name('User home');
    Route::get('/product/{id}',[CustomerController::class,  'SHOWEACHPRODUCT'])->name('Each Product');
    Route::post('/userlogout', [CustomerController::class, 'USERLOGOUT'])->name('UserLogout');
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
    Route::get('/vendorrequests', [AdminController::class, 'VENDORREQUESTS'])->name('VendorsRequests');
    Route::post('/approverequest/{id}', [AdminController::class, 'UPDATEAPPROVESTATUS'])->name('ApproveRequest');
});

// Vendor
Route::get('/vendorloginpage', [VendorController::class, 'VENDORLOGINPAGE'])
    ->name('VendorLoginPage');
Route::get('/vendorsignuppage', [VendorController::class, 'VENDORSIGNUPPAGE'])
    ->name('VendorSignupPage');
Route::post('/vendorregister', [VendorController::class, 'VENDORSIGNUP'])
    ->name('VendorSignup');
Route::post('/vendorlogin', [VendorController::class, 'VENDORLOGIN'])
    ->name('VendorLogin');
Route::middleware(['vendor'])->group(function () {
    Route::get('/vendor', [VendorController::class, 'VENDORHOME'])->name('Vendor home');
    Route::get('/addproduct', [VendorController::class, 'ADDPRODUCT'])->name('Add product');
    Route::post('/storeproduct', [VendorController::class, 'STOREPRODUCT'])->name('Store product');
    Route::post('/vendorlogout', [VendorController::class, 'VENDORLOGOUT'])->name('VendorLogout');
    Route::get('/vendorprofile', [VendorController::class, 'VENDORPROFILE'])->name('VendorProfile');
});

Route::get('/test-request', function () {
    dd(class_exists(\App\Http\Requests\ProductRequest::class));
});
