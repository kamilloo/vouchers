<?php

use App\Models\Voucher;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function (){
  Route::get('/user', function (Request $request) {
      return $request->user();
  });

    Route::post('/logout', 'Auth\ApiController@logout');


    Route::get('/vouchers/{qr_code}', 'Api\VoucherController@get')
      ->name('api-voucher-get');

  Route::post('/vouchers/{qr_code}/pay', 'Api\VoucherController@pay')
      ->name('api-voucher-pay');
});

Route::group(['middleware' => 'paymentOrderIsActive'], function () {
    Route::post('payment/{payment}/callback-status', 'PaymentOrderController@callbackStatus')->name('payment.status');
});

Route::post('/register', 'Auth\ApiController@register');

Route::post('/login', 'Auth\ApiController@login');

Route::post('/subscribe', 'SubscriberController@add')->name('subscribe');


