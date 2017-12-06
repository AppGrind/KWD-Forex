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

Auth::routes();

Route::get('/', function () {
    return view('landing');
});

//Get in Touch form  routes
Route::post('/get-in-touch', ['as' => 'get-in-touch', 'uses' => 'HomeController@get_in_touch']);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('items', 'ItemController');
Route::resource('events','EventController');
Route::resource('bookings', 'BookingController');
Route::resource('invoices', 'InvoiceController');
Route::resource('users', 'UserController');
Route::resource('bookings', 'BookingController');
Route::resource('notifications', 'BookingController');

Route::post('users/{user}/update_password', 'UserController@update_password')->name('user.update_password');
Route::post('events/{event}/publish', 'EventController@publish')->name('events.publish');