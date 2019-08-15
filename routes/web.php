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

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/template-{id}', function ($id){
    return view('templates.template'.$id);
});


Auth::routes();


Route::middleware('auth')->group(function (){
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/edit', 'ProfileController@update')->name('profile.update');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::get('/payments', 'VoucherController@index')->name('payments.index');
    Route::get('/wizard', 'VoucherController@index')->name('wizard');
    Route::get('/shop', 'VoucherController@index')->name('shop');


    Route::resource('/vouchers', 'VoucherController');
    Route::resource('/orders', 'OrderController');

});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('get-started', 'Starter@getStarted')->name('get-started');

Route::get('checkout/{merchant}', 'CheckoutController@start')->name('checkout.start');
Route::post('checkout/{merchant}', 'CheckoutController@proceed')->name('checkout.proceed');
Route::get('checkout/{merchant}/confirmation', 'CheckoutController@confirmation')->name('checkout.confirmation');


Route::get('payment/{merchant}/create/{order}', 'PaymentController@create')->name('payment.create');
Route::get('payment/{merchant}/callback-return', 'PaymentController@return')->name('payment.return');
Route::post('payment/callback-status', 'PaymentController@status')->name('payment.status');

//Route::get('voucher/download');
//Route::get('voucher/send');
//Route::get('voucher/push');
