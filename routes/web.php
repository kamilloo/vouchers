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
//    Route::get('/wizard', 'HomeController@index')->name('wizard');

    Route::get('/shop', 'ShopController@index')->name('shop.index');
    Route::post('/shop/change-template', 'ShopController@changeTemplate')->name('shop.change-template');
    Route::post('/shop/custom-template', 'ShopController@customTemplate')->name('shop.custom-template');
    Route::post('/shop/change-images', 'ShopController@changeImages')->name('shop.change-images');
    Route::post('/shop/gateway-settings', 'ShopController@gatewaySettings')->name('shop.gateway-settings');
    Route::post('/shop/shop-settings', 'ShopController@shopSettings')->name('shop.shop-settings');

    Route::resource('/vouchers', 'VoucherController');
    Route::resource('/orders', 'OrderController');
    Route::resource('/payments', 'TransactionController');
    Route::resource('/service-categories', 'ServiceCategoryController');
    Route::resource('/service-packages', 'ServicePackageController');
    Route::resource('/services', 'ServiceController');

});


Route::get('/home', 'HomeController@index')->name('home');


Route::get(__('checkout').'/{merchant}', 'CheckoutController@start')->name('checkout.start');
Route::post(__('checkout').'/{merchant}', 'CheckoutController@proceed')->name('checkout.proceed');

Route::group(['middleware' => 'canOrderProceeded'], function () {
    Route::get(__('checkout').'/{merchant}/'.__('confirmation').'/{order}', 'CheckoutController@confirmation')->name('checkout.confirmation');

    Route::get(__('payment').'/{merchant}/'.__('create').'/{order}', 'PaymentOrderController@create')->name('payment.create');
});

Route::group(['middleware' => 'paymentOrderIsActive'], function () {
    Route::get('payment/{payment}/callback-return', 'PaymentOrderController@callbackReturn')->name('payment.return');
    Route::get('payment/{payment}/sandbox-gateway', 'PaymentOrderController@sandboxGateway')->name('payment.sandbox-gateway');

    Route::get(__('payment').'/{payment}/'.__('recap'), 'PaymentOrderController@recap')->name('payment.recap');
});

Route::get(__('voucher').'/order/{order}/'.__('failed'), 'VoucherOrderController@failed')->name('voucher.failed');


Route::group(['middleware' => ['orderIsActive', 'voucherIsWaiting']], function (){

    Route::get(__('voucher').'/'.__('order').'/{order}/'.__('download'), 'VoucherOrderController@download')->name('voucher.download');
    Route::get(__('voucher').'/'.__('order').'/{order}/'.__('send'), 'VoucherOrderController@send')->name('voucher.send');
    Route::get(__('voucher').'/'.__('order').'/{order}/'.__('push'), 'VoucherOrderController@push')->name('voucher.push');

});

$hash_models = [
    'merchant',
    'order',
    'payment',
    'service',
    'service_category',
    'service_package',
    'voucher',

];

foreach ($hash_models as $model)
{
    Route::bind($model, function($value, $route)
    {
        return trim(Hashids::decodeHex($value), config('hashids.start_primary_key'));
    });
}

