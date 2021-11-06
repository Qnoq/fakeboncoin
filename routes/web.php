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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// Ads Routes
Route::get('/', 'AdController@index')->name('ad.index');
Route::get('/annonce', 'AdController@create')->name('ad.create');
Route::post('/annonce/create', 'AdController@store')->name('ad.store');
Route::get('/search', 'AdController@search')->name('ads.search');

// Messages Routes
Route::get('/message/{seller_id}/{ad_id}', 'MessageController@create')->name('message.create');
Route::post('/message', 'MessageController@store')->name('message.store');

