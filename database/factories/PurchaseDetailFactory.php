<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\PurchaseDetail;
use Faker\Generator as Faker;

$factory->define(PurchaseDetail::class, function (Faker $faker) {
    $quantity = $faker->numberBetween(1, 90);
    return [
        'product_id' => Product::all()->random()->id,
        'init_quantity' => $quantity,
        'current_quantity' => $quantity,
        'unit_price' => $faker->randomFloat(2, 8, 87),
    ];
});
