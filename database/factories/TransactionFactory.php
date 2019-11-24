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

$factory->define(\App\Models\Transaction::class, function (Faker $faker) {
    return [
        'payment_id' => function(){
            return factory(\App\Models\Payment::class)->create()->id;
        },
        'order_amount' => $faker->randomFloat(2,1,1000),
        'url_return' => $faker->url,
        'url_status' => $faker->url,
        'client_email' => $faker->email,
        'client_name' => $faker->name,
        'client_phone' => $faker->phoneNumber,
        'client_address' => $faker->address,
        'client_postcode' => $faker->postcode,
        'client_city' => $faker->city,
        'client_country' => $faker->country,
        'order_description' => $faker->text(),
        'product_title' => $faker->title,
        'product_description' => $faker->text(),
        'session_id' => $faker->uuid,
        'token' => $faker->uuid,
        'is_register' => $faker->boolean,
        'request_parameters' => $faker->shuffleArray(),
        'error_code' => $faker->numerify(),
        'error_description' => $faker->shuffleArray(),

    ];
});
