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
    Route::get('/'.__('profile'), 'ProfileController@index')->name('profile.index');
    Route::post('/'.__('profile').'/'.__('edit'), 'ProfileController@update')->name('profile.update');
    Route::get('/'.__('profile').'/'.__('edit'), 'ProfileController@edit')->name('profile.edit');
//    Route::get('/wizard', 'HomeController@index')->name('wizard');

    Route::get('/'.__('shop'), 'ShopController@index')->name('shop.index');
    Route::post('/'.__('shop').'/'.__('change-template'), 'ShopController@changeTemplate')->name('shop.change-template');
    Route::post('/'.__('shop').'/'.__('custom-template'), 'ShopController@customTemplate')->name('shop.custom-template');
    Route::post('/'.__('shop').'/'.__('change-images'), 'ShopController@changeImages')->name('shop.change-images');
    Route::post('/'.__('shop').'/'.__('gateway-settings'), 'ShopController@gatewaySettings')->name('shop.gateway-settings');
    Route::post('/'.__('shop').'/'.__('shop-settings'), 'ShopController@shopSettings')->name('shop.shop-settings');


    Route::get('/'.__('vouchers'), 'VoucherController@index')->name('vouchers.index');
    Route::get('/'.__('vouchers').'/'.__('create'), 'VoucherController@create')->name('vouchers.create');
    Route::post('/'.__('vouchers').'/'.__('store'), 'VoucherController@store')->name('vouchers.store');
    Route::get('/'.__('vouchers').'/{voucher}/'.__('edit'), 'VoucherController@edit')->name('vouchers.edit');
    Route::put('/'.__('vouchers').'/{voucher}/'.__('update'), 'VoucherController@update')->name('vouchers.update');
    Route::delete('/'.__('vouchers').'/{voucher}', 'VoucherController@destroy')->name('vouchers.destroy');

    Route::get('/'.__('orders'), 'OrderController@index')->name('orders.index');
    Route::get('/'.__('orders').'/'.__('create'), 'OrderController@create')->name('orders.create');
    Route::post('/'.__('orders').'/'.__('store'), 'OrderController@store')->name('orders.store');
    Route::get('/'.__('orders').'/{order}/'.__('edit'), 'OrderController@edit')->name('orders.edit');
    Route::put('/'.__('orders').'/{order}/'.__('update'), 'OrderController@update')->name('orders.update');
    Route::delete('/'.__('orders').'/{order}', 'OrderController@destroy')->name('orders.destroy');

    Route::get('/'.__('payments'), 'TransactionController@index')->name('payments.index');
    Route::get('/'.__('payments').'/'.__('create'), 'TransactionController@create')->name('payments.create');
    Route::post('/'.__('payments').'/'.__('store'), 'TransactionController@store')->name('payments.store');
    Route::get('/'.__('payments').'/{transaction}/'.__('edit'), 'TransactionController@edit')->name('payments.edit');
    Route::put('/'.__('payments').'/{transaction}/'.__('update'), 'TransactionController@update')->name('payments.update');
    Route::delete('/'.__('payments').'/{transaction}', 'TransactionController@destroy')->name('payments.destroy');


    Route::get('/'.__('service-categories'), 'ServiceCategoryController@index')->name('service-categories.index');
    Route::get('/'.__('service-categories').'/'.__('create'), 'ServiceCategoryController@create')->name('service-categories.create');
    Route::post('/'.__('service-categories').'/'.__('store'), 'ServiceCategoryController@store')->name('service-categories.store');
    Route::get('/'.__('service-categories').'/{service_category}/'.__('edit'), 'ServiceCategoryController@edit')->name('service-categories.edit');
    Route::put('/'.__('service-categories').'/{service_category}/'.__('update'), 'ServiceCategoryController@update')->name('service-categories.update');
    Route::delete('/'.__('service-categories').'/{service_category}', 'ServiceCategoryController@destroy')->name('service-categories.destroy');


    Route::get('/'.__('service-packages'), 'ServicePackageController@index')->name('service-packages.index');
    Route::get('/'.__('service-packages').'/'.__('create'), 'ServicePackageController@create')->name('service-packages.create');
    Route::post('/'.__('service-packages').'/'.__('store'), 'ServicePackageController@store')->name('service-packages.store');
    Route::get('/'.__('service-packages').'/{service_package}/'.__('edit'), 'ServicePackageController@edit')->name('service-packages.edit');
    Route::put('/'.__('service-packages').'/{service_package}/'.__('update'), 'ServicePackageController@update')->name('service-packages.update');
    Route::delete('/'.__('service-packages').'/{service_package}', 'ServicePackageController@destroy')->name('service-packages.destroy');

    Route::get('/'.__('services'), 'ServiceController@index')->name('services.index');
    Route::get('/'.__('services').'/'.__('create'), 'ServiceController@create')->name('services.create');
    Route::post('/'.__('services').'/'.__('store'), 'ServiceController@store')->name('services.store');
    Route::get('/'.__('services').'/{service}/'.__('edit'), 'ServiceController@edit')->name('services.edit');
    Route::put('/'.__('services').'/{service}/'.__('update'), 'ServiceController@update')->name('services.update');
    Route::delete('/'.__('services').'/{service}', 'ServiceController@destroy')->name('services.destroy');

});


Route::get('/'.__('home'), 'HomeController@index')->name('home');


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

Route::get(__('voucher').'/'.__('order').'/{order}/'.__('failed'), 'VoucherOrderController@failed')->name('voucher.failed');


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
        return ltrim(Hashids::decodeHex($value), '0');
    });
}

