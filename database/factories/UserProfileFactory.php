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

$factory->define(\App\Models\UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'first_name' => $faker->unique()->firstName,
        'last_name' => $faker->unique()->name,
        'company_name' => $faker->unique()->name,
        'address' => $faker->address,
        'city' => $faker->unique()->city,
        'postcode' => $faker->unique()->postcode,
        'avatar' => $faker->url,
        'services' => $faker->word,
        'branch' => $faker->word,
        'description' => $faker->text,
    ];
});
