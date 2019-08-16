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

$factory->define(\App\Models\ShopImage::class, function (Faker $faker) {
    return [
        'merchant_id' => function(){
            return factory(\App\Models\Merchant::class)->create()->id;
        },
        'logo_enabled' => $faker->boolean,
        'front_enabled' => $faker->boolean,
        'logo' => $faker->url,
        'front' => $faker->url,
    ];
});
