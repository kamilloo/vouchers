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

$factory->define(Voucher::class, function (Faker $faker) {

    $product = factory(Service::class)->create();

    $product_type = MorphType::PRODUCT . '_type';

    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'merchant_id' => function(){
            return factory(Merchant::class)->create()->id;
        },
        'product_id' => $product->id,
        $product_type => ProductType::SERVICE,
        'type' => $faker->randomElement(VoucherType::all()),
        'description' => $faker->title,
        'price' => $faker->randomFloat(2,1,1000),
    ];
});

$factory->state(Voucher::class, 'mine', function(){
    return [
        'user_id' => auth()->id()
    ];
});


$factory->state(Voucher::class, VoucherType::QUOTE, function(){
    return [
        'type' => VoucherType::QUOTE
    ];
});


$factory->state(Voucher::class, VoucherType::SERVICE, function(){
    return [
        'type' => VoucherType::SERVICE
    ];
});



