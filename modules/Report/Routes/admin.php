<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'booking'],function (){
    Route::get('/','BookingController@index')->name('report.admin.booking');
    Route::get('/email_preview/{id}','BookingController@email_preview')->name('report.admin.booking.email_preview');
    Route::post('/bulkEdit','BookingController@bulkEdit')->name('report.admin.booking.bulkEdit');
});
Route::get('/enquiry','EnquiryController@index')->name('report.admin.enquiry.index');

Route::post('/enquiry/bulkEdit','EnquiryController@bulkEdit')->name('report.admin.enquiry.bulkEdit');


Route::get('/statistic','StatisticController@index')->name('report.admin.statistic.index');
Route::match(['get','post'],'/statistic/reloadChart','StatisticController@reloadChart')->name('report.admin.statistic.reloadChart');

Route::group(['prefix'=>'booking-request'],function (){
   Route::get('/','BookingRequestController@index')->name('report.admin.booking-request');
   Route::get('/edit/{id}','BookingRequestController@edit')->name('report.admin.request-edit');
   Route::post('/edit/{id}','BookingRequestController@store')->name('report.admin.request-edit-post');
});

Route::get('/accept-commission/{id}','BookingController@acceptCommission')->name('report.admin.accept-commission');
Route::post('/post-accept-commission','BookingController@postAcceptCommission')->name('report.admin.post-accept-commission');
