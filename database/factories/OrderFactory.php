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

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        'merchant_id' => function(){
            return factory(\App\Models\Merchant::class)->create()->id;
        },
        'voucher_id' => function(){
            return factory(\App\Models\Voucher::class)->create()->id;
        },
        'delivery' => $faker->randomElement(\App\Models\Enums\DeliveryType::all()),
        'price' => $faker->randomFloat(4,1,100000),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'status' => $faker->randomElement(\App\Models\Enums\StatusType::all()),
        'paid' => $faker->randomElement(\App\Models\Enums\PaymentStatus::all()),
    ];
});
