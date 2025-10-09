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
Route::get('/ACC', [CustomerController::class, 'GETAC'])
    ->name('ACC');
Route::get('/TVC', [CustomerController::class, 'GETTV'])
    ->name('TVC');
Route::get('/AirCoolerC', [CustomerController::class, 'GETAIRCOOLER'])
    ->name('AirCoolerC');
Route::get('/FridgeC', [CustomerController::class, 'GETFRIDGE'])
    ->name('FridgeC');
Route::get('/WashingMachineC', [CustomerController::class, 'GETWASHINGMACHINE'])
    ->name('WashingMachineC');
Route::get('/OvenC', [CustomerController::class, 'GETOVEN'])
    ->name('OvenC');
Route::get('/BlenderC', [CustomerController::class, 'GETBLENDER'])
    ->name('BlenderC');
Route::get('/DishWasherC', [CustomerController::class, 'GETDISHWASHER'])
    ->name('DishWasherC');
Route::get('/ChimneyC', [CustomerController::class, 'GETCHIMNEY'])
    ->name('ChimneyC');
Route::get('/ElectricStoveC', [CustomerController::class, 'GETELECTRICSTOVE'])
    ->name('ElectricStoveC');
Route::get('/RiceCookerC', [CustomerController::class, 'GETRICECOOKER'])
    ->name('RiceCookerC');
Route::get('/CeilingFanC', [CustomerController::class, 'GETCEILINGFAN'])
    ->name('CeilingFanC');
Route::get('/ToasterC', [CustomerController::class, 'GETTOASTER'])
    ->name('ToasterC');
Route::get('/VacuumCleanerC', [CustomerController::class, 'GETVACUUMCLEANER'])
    ->name('VacuumCleanerC');
Route::get('/WaterHeaterC', [CustomerController::class, 'GETWATERHEATER'])
    ->name('WaterHeaterC');
Route::get('/BulbC', [CustomerController::class, 'GETBULB'])
    ->name('BulbC');
Route::get('/IronC', [CustomerController::class, 'GETIRON'])
    ->name('IronC');
Route::get('/AirPurifierC', [CustomerController::class, 'GETAIRPURIFIER'])
    ->name('AirPurifierC');
Route::get('/search', [CustomerController::class, 'SEARCH'])
    ->name('Search');
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
    Route::get('/orders', [CustomerController::class, 'BATCHORDERSPENDING'])
        ->name('Orders');
    Route::get('/shippedordersc', [CustomerController::class, 'BATCHORDERSSHIPPED'])
        ->name('ShippedOrdersc');
    Route::get('/deliveredorders', [CustomerController::class, 'BATCHORDERSDONE'])
        ->name('deliveredOrders');
    Route::get('/pdf/{id}', [CustomerController::class, 'GETPDF'])
        ->name('Pdf');
    Route::get('/transactions', [CustomerController::class, 'TOTALTRANSACTION'])
        ->name('Trans');
    Route::get('/changepasswordc', [CustomerController::class, 'SHOWCHANGEPASS'])
        ->name('Passpagec');
    Route::post('/changepasswordc', [CustomerController::class, 'CHANGEPASS'])
        ->name('Passchangec');
    Route::get('/updateprofile', [CustomerController::class, 'SHOWUPDATEPAGE'])
        ->name('Showupdateprofile');
    Route::post('/updateprofile', [CustomerController::class, 'UPDATEPROFILE'])
        ->name('Updateprofile');
    Route::get('/ordercount', [CustomerController::class, 'COUNTORDERS'])
        ->name('ordercount');
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
    Route::get('/shippedordersadmin', [AdminController::class, 'SHIPPEDORDERS'])
        ->name('ShippedOrdersadmin');
    Route::post('/update-delivery-status-shipted/{order_batch_id}', [AdminController::class, 'UPDATEDELIVERYSTATUSDONE'])
        ->name('UpdateDeliveryStatusDone');
    Route::get('/admin', [AdminController::class, 'COUNTSALEPERMONTH'])
        ->name('Admin home');
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
    Route::get('/products', [VendorController::class, 'PRODUCTS'])
        ->name('Products');
    Route::post('/deleteproduct/{id}', [VendorController::class, 'WIPEOUTPRODUCT'])
        ->name('Deleteproduct');
    Route::get('/stockoutedproducts', [VendorController::class, 'STOCKOUTPRODUCT'])
        ->name('Stockoutproduct');
    Route::get('/shippedorders', [VendorController::class, 'BATCHORDERSSHIPPED'])
        ->name('ShippedOrders');
    Route::get('/delivereddorders', [VendorController::class, 'BATCHORDERSSHIPPEDDONE'])
        ->name('DeliveredOrders');
    Route::get('/ACV', [VendorController::class, 'GETACV'])
        ->name('ACV');
    Route::get('/AirCooler', [VendorController::class, 'GETAirCoolerV'])
        ->name('AirCooler');
    Route::get('/TV', [VendorController::class, 'GETTVV'])
        ->name('TV');
    Route::get('/Fridge', [VendorController::class, 'GETFridgeV'])
        ->name('Fridge');
    Route::get('/WashingMachine', [VendorController::class, 'GETWashingMachineV'])
        ->name('WashingMachine');
    Route::get('/Oven', [VendorController::class, 'GETOvenV'])
        ->name('Oven');
    Route::get('/Blender', [VendorController::class, 'GETBlenderV'])
        ->name('Blender');
    Route::get('/DishWasher', [VendorController::class, 'GETDishWasherV'])
        ->name('DishWasher');
    Route::get('/Chimney', [VendorController::class, 'GETChimneyV'])
        ->name('Chimney');
    Route::get('/ElectricStove', [VendorController::class, 'GETElectricStoveV'])
        ->name('ElectricStove');
    Route::get('/RiceCooker', [VendorController::class, 'GETRiceCookerV'])
        ->name('RiceCooker');
    Route::get('/CeilingFan', [VendorController::class, 'GETCeilingFanV'])
        ->name('CeilingFan');
    Route::get('/Toaster', [VendorController::class, 'GETToasterV'])
        ->name('Toaster');
    Route::get('/VacuumCleaner', [VendorController::class, 'GETVacuumCleanerV'])
        ->name('VacuumCleaner');
    Route::get('/WaterHeater', [VendorController::class, 'GETWaterHeaterV'])
        ->name('WaterHeater');
    Route::get('/Bulb', [VendorController::class, 'GETBulbV'])
        ->name('Bulb');
    Route::get('/Iron', [VendorController::class, 'GETIronV'])
        ->name('Iron');
    Route::get('/AirPurifier', [VendorController::class, 'GETAirPurifierV'])
        ->name('AirPurifier');
    Route::post('/restockproduct/{id}', [VendorController::class, 'RESTOCK'])
        ->name('restocked');
    Route::get('/updateproductpage/{id}', [VendorController::class, 'VIEWUPDATEPRODUCTPAGE'])
        ->name('viewupdatepage');
    Route::post('/updateproduct/{id}', [VendorController::class, 'UPDATEPRODUCTINFO'])
        ->name('Updateproduct');
    Route::get('/vendor', [VendorController::class, 'COUNTITEMSALE'])
        ->name('Vendor home');
    Route::get('/vendorc', [VendorController::class, 'COUNTSALE'])
        ->name('Vendor homec');
    Route::get('/changepassword', [VendorController::class, 'SHOWCHANGEPASSV'])
        ->name('Passpagev');
    Route::post('/changepassword', [VendorController::class, 'CHANGEPASSV'])
        ->name('Passchangev');
});
