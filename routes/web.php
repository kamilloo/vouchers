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
    Route::get('/wizard', 'WizardController@index')->name('wizard');

    Route::get('/shop', 'ShopController@index')->name('shop.index');
    Route::post('/shop/change-template', 'ShopController@changeTemplate')->name('shop.change-template');
    Route::post('/shop/custom-template', 'ShopController@customTemplate')->name('shop.custom-template');
    Route::post('/shop/change-images', 'ShopController@changeImages')->name('shop.change-images');

    Route::resource('/vouchers', 'VoucherController');
    Route::resource('/orders', 'OrderController');
    Route::resource('/payments', 'TransactionController');

});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('get-started', 'Starter@getStarted')->name('get-started');

Route::get('checkout/{merchant}', 'CheckoutController@start')->name('checkout.start');
Route::post('checkout/{merchant}', 'CheckoutController@proceed')->name('checkout.proceed');
Route::get('checkout/{merchant}/confirmation/{order}', 'CheckoutController@confirmation')->name('checkout.confirmation');


Route::get('payment/{merchant}/create/{order}', 'PaymentController@create')->name('payment.create');
Route::get('payment/{payment}/callback-return', 'PaymentController@callbackReturn')->name('payment.return');
Route::post('payment/{payment}/callback-status', 'PaymentController@callbackStatus')->name('payment.status');
Route::get('payment/{payment}/sandbox-gateway', 'PaymentController@sandboxGateway')->name('payment.sandbox-gateway');


Route::get('payment/{payment}/recap', 'PaymentController@recap')->name('payment.recap');

Route::get('voucher/order/{order}/download', 'VoucherOrderController@download')->name('voucher.download');
Route::get('voucher/order/{order}/send', 'VoucherOrderController@send')->name('voucher.send');
Route::get('voucher/order/{order}/push', 'VoucherOrderController@push')->name('voucher.push');
