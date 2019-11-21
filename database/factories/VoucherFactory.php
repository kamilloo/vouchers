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

$factory->define(\App\Models\Voucher::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'merchant_id' => function(){
            return factory(\App\Models\Merchant::class)->create()->id;
        },
        'type' => 'type',
        'title' => $faker->title,
        'price' => $faker->randomFloat(),
//        'service' => $faker->word
    ];
});

$factory->state(\App\Models\Voucher::class, 'mine', function(){
    return [
        'user_id' => auth()->id()
    ];
});
