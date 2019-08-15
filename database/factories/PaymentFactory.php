<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Payment::class, function (Faker $faker) {
    return [
        'merchant_id' => function(){
            return factory(\App\Models\Merchant::class)->create()->id;
        },
        'order_id' => function(){
            return factory(\App\Models\Order::class)->create()->id;
        },
    ];
});
