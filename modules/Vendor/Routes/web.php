<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'vendor'],function(){
    Route::post('/register','VendorController@register')->name('vendor.register');
    Route::get('/profile/{id}','VendorController@profile')->name('vendor.profile');
});

Route::group(['prefix'=>'vendor','middleware' => ['auth']],function(){
    Route::match(['get'],'/payouts','PayoutController@index')->name("vendor.payout.index");
    Route::post('/storePayoutAccounts','PayoutController@storePayoutAccounts')->name("vendor.payout.storePayoutAccounts");
    Route::post('/createPayoutRequest','PayoutController@createPayoutRequest')->name("vendor.payout.createPayoutRequest");

    Route::get('/booking-report','VendorController@bookingReport')->name("vendor.bookingReport");
    Route::get('/booking-request-report','VendorController@bookingRequestReport')->name("vendor.bookingRequestReport");
    Route::get('/booking-request-update/{id}','VendorController@bookingRequesUpdate')->name("vendor.bookingRequestUpdate");
    Route::post('/booking-request-update/{id}','VendorController@upgrade')->name("vendor.bookingRequestUpdate.post");
    //Danh sách user của vendor
    Route::get('/list-user','VendorController@listUser')->name('vendor.list-user');
    Route::get('/add-new-user','VendorController@addUser')->name('vendor.add-user');
    Route::get('/edit-vendor-user/{id}','VendorController@edit')->name('vendor.edit-vendor-user');
    Route::post('/vendor-user-store/{id}','VendorController@store')->name('vendor.post-vendor-user');
});
