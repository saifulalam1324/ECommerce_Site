<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Models\Vendor;


//User
Route::post('/usersignup', [CustomerController::class, 'USERSIGNUP'])
    ->name('UserSignup');
Route::post('/userlogin', [CustomerController::class, 'USERLOGIN'])
    ->name('UserLogin');
Route::get('/login', [CustomerController::class, 'LOGINSIGNUP'])
    ->name('LoginSignup');
Route::get('/', [CustomerController::class, 'HOME'])
    ->name('User home');
Route::get('/product/{id}', [CustomerController::class,  'SHOWEACHPRODUCT'])
    ->name('Each Product');
Route::middleware(['customer'])->group(function () {
    Route::post('/userlogout', [CustomerController::class, 'USERLOGOUT'])
        ->name('UserLogout');
    Route::get('/cart', [CustomerController::class, 'CART'])
        ->name('Cart');
    Route::post('/cartadd/{id}', [CustomerController::class, 'ADDTOCART'])
        ->name('Addtocart');
    Route::post('/updatecart/{id}', [CustomerController::class, 'UPDATECART'])
        ->name('Updatecart');
    Route::post('/cartremove/{id}', [CustomerController::class, 'REMOVECART'])
        ->name('Removecart');
    Route::post('/inc/{id}', [CustomerController::class, 'INCREASE'])
        ->name('INC');
    Route::post('/dic/{id}', [CustomerController::class, 'DECREASE'])
        ->name('DEC');
    Route::post('/remove/{id}', [CustomerController::class, 'REMOVECART'])
        ->name('Removecart');
    Route::get('/userinfo', [CustomerController::class, 'USERINFO'])
        ->name('UserInfo');
    Route::get('/payment', [CustomerController::class, 'SHOWPAYMENTPAGE'])
        ->name('Paymentpage');
    Route::post('/placeorder', [CustomerController::class, 'PLACEORDER'])
        ->name('Placeorder');
    Route::post('/processpayment', [CustomerController::class, 'processPayment'])
        ->name('Processpayment');
    Route::post('/ppayment', [CustomerController::class, 'payment'])
        ->name('payment');
    Route::get('/search', [CustomerController::class, 'SEARCH'])
        ->name('Search');
    Route::get('/orders', [CustomerController::class, 'BATCHORDERSPENDING'])
        ->name('Orders');
    Route::get('/pdf/{id}', [CustomerController::class, 'GETPDF'])
        ->name('Pdf');
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
    Route::get('/admin', [AdminController::class, 'ADMINHOME'])
        ->name('Admin home');
    Route::get('/allusers', [AdminController::class, 'READUSERS'])
        ->name('All users');
    Route::get('/allvendors', [AdminController::class, 'READVENDORS'])
        ->name('All vendors');
    Route::get('/vendoreach/{id}', [AdminController::class, 'READVENDORS1'])
        ->name('Each vendors');
    Route::post('/adminlogout', [AdminController::class, 'ADMINLOGOUT'])
        ->name('AdminLogout');
    Route::get('/adminprofile', [AdminController::class, 'ADMINPROFILE'])
        ->name('AdminProfile');
    Route::get('/vendorrequests', [AdminController::class, 'VENDORREQUESTS'])
        ->name('VendorsRequests');
    Route::post('/approverequest/{id}', [AdminController::class, 'UPDATEAPPROVESTATUS'])
        ->name('ApproveRequest');
    Route::post('/deleterequest/{id}', [AdminController::class, 'DELETEREQUEST'])
        ->name('DeleteRequest');
    Route::get('/adminorders', [AdminController::class, 'BATCHORDERSALL'])
        ->name('AllOrders');
    Route::post('/update-delivery-status/{order_batch_id}', [AdminController::class, 'UPDATEDELIVERYSTATUS'])
        ->name('UpdateDeliveryStatus');
    Route::get('/completedorders', [AdminController::class, 'COMPLETEDORDERS'])
        ->name('CompletedOrders');
    Route::get('/shippedorders', [AdminController::class, 'SHIPPEDORDERS'])
        ->name('ShippedOrders');
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
    Route::get('/vendor', [VendorController::class, 'VENDORHOME'])
        ->name('Vendor home');
    Route::get('/addproduct', [VendorController::class, 'ADDPRODUCT'])
        ->name('Add product');
    Route::post('/storeproduct', [VendorController::class, 'STOREPRODUCT'])
        ->name('Store product');
    Route::post('/vendorlogout', [VendorController::class, 'VENDORLOGOUT'])
        ->name('VendorLogout');
    Route::get('/vendorprofile', [VendorController::class, 'VENDORPROFILE'])
        ->name('VendorProfile');
    Route::get('/batchorders', [VendorController::class, 'BATCHORDERS'])
        ->name('BatchOrders');
});
