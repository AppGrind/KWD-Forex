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
Route::get('/verification', 'HomeController@verification')->name('verification');
Route::post('/verify/account', 'UserController@verify_account')->name('verify.account');
Route::get('/account/{user}/password/edit', 'UserController@edit_password')->name('password.edit');
Route::post('/account/{user}/password/update', 'UserController@update_password')->name('password.update');

Route::resource('items', 'ItemController');

Route::resource('events','EventController');
Route::post('events/{event}/publish', 'EventController@publish')->name('events.publish');

//BookingController routes
Route::resource('bookings', 'BookingController', ['except' => ['create', 'edit', 'update']]);
Route::get('/bookings/{event}/guest/add', 'BookingController@add_guest')->name('guest.add');
Route::post('/bookings/{event}/guest/save', 'BookingController@save_guest')->name('guest.save');
Route::get('/bookings/{event}/guests/print', 'BookingController@print_guests')->name('guests.print');
Route::post('/bookings/{booking}/attachment/upload', 'BookingController@upload')->name('attachment.upload');
Route::get('/bookings/{booking}/approve', 'BookingController@approve')->name('booking.approve');
Route::post('/bookings/{booking}/decline', 'BookingController@decline')->name('booking.decline');

Route::resource('invoices', 'InvoiceController');
Route::get('invoices/{invoice}/print', 'InvoiceController@print')->name('invoices.print');

Route::resource('users', 'UserController');
Route::resource('bookings', 'BookingController');
Route::get('notifications/{notification}/read', 'NotificationController@read')->name('notification.read');
Route::delete('notifications/{notification}', 'NotificationController@destroy')->name('notification.delete');

Route::post('users/{user}/update_password', 'UserController@update_password')->name('user.update_password');



//ajax routes
Route::prefix('ajax')->group(function () {
    Route::post('verify', 'AjaxController@verify_account')->name('ajax.verify');
});

//test mailable view
Route::get('/mailable', function () {
    $user = App\User::find(1);
    $admin = App\User::find(1);
    $booking = App\Booking::find(19);
    $event = App\Event::find(4);
    return new App\Mail\BookingAttachmentUploadedAdminEmail($admin, $booking);
});
