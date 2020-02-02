<?php

use App\Models\Client;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\PaymentStatus;
use App\Models\Enums\StatusType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
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

$factory->define(Order::class, function (Faker $faker) {
    return [
        'client_id' => function(){
            return factory(Client::class)->create()->id;
        },
        'merchant_id' => function(){
            return factory(Merchant::class)->create()->id;
        },
        'voucher_id' => function(){
            return factory(Voucher::class)->create()->id;
        },
        'delivery' => $faker->randomElement(DeliveryType::all()),
        'price' => $faker->randomFloat(4,1,100000),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'qr_code' => $faker->randomAscii,
        'status' => $faker->randomElement(StatusType::all()),
        'paid' => $faker->randomElement(PaymentStatus::all()),
    ];
});
foreach (StatusType::all() as $status)
{
    $factory->state(Order::class, $status, function () use ($status){
        return [
            'status' => $status,
        ];
    });
}

