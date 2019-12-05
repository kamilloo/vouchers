
<?php

use App\Models\Descriptors\MorphType;
use App\Models\Descriptors\ProductType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Service;
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

$factory->define(\App\Models\Skill::class, function (Faker $faker) {

    return [
        'name' => $faker->title,
        'slug' => $faker->slug,
    ];
});



