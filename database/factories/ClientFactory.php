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

$factory->define(\App\Models\Client::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'city' => $faker->city,
        'address' => $faker->address,
        'postcode' => $faker->postcode,
        'country' => $faker->country,
    ];
});
