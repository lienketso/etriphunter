<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','CompanyController@index')->name('company.admin.index');
Route::get('/create','CompanyController@create')->name('company.admin.create');
Route::get('/edit/{id}','CompanyController@edit')->name('company.admin.edit');
Route::post('/store/{id}','CompanyController@store')->name('company.admin.store');
