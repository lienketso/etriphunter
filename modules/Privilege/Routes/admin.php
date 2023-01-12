<?php
use \Illuminate\Support\Facades\Route;


Route::get('/','PrivilegeController@index')->name('privilege.admin.index');
Route::get('/create','PrivilegeController@getcreate')->name('privilege.admin.getcreate');
Route::post('/create','PrivilegeController@postcreate')->name('privilege.admin.postcreate');
Route::get('/detail/{id}','PrivilegeController@getedit')->name('privilege.admin.detail');
Route::post('/edit/{id}','PrivilegeController@postedit')->name('privilege.admin.postedit');
Route::get('/user','PrivilegeController@viewuser')->name('privilege.admin.user');
Route::get('/userdetail/{id}','PrivilegeController@userdetail')->name('privilege.admin.userdetail');
Route::post('/userdetail/{id}','PrivilegeController@useredit')->name('privilege.admin.useredit');
Route::post('/bulkEdit','PrivilegeController@bulkEdit')->name('privilege.admin.bulkEdit');
Route::get('/upgradereqest','PrivilegeController@upgradereqest')->name('privilege.admin.upgraderequest');


