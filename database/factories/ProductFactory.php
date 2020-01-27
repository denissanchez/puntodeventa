<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Branch;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $number_one = $faker->numberBetween(1, 90);
    $number_two = $faker->numberBetween(100, 999);
    return [
        'branch_id' => Branch::all()->random()->id,
        'code' => 'CODE-FAKE0'.$number_one,
        'category' => 'CATEG-FAKE0'.$number_one,
        'brand' => 'BRAND-FAKE0'.$number_one,
        'laboratory' => 'LAB-FAKE0'.$number_one,
        'measure_unit' => 'UM-FAKE0'.$number_one,
        'name' => 'PROD-FAKE0'.$number_one.'-'.$number_two,
        'composition' => 'COMP-FAKE0'.$number_one.'-'.$number_two,
        'description' => 'DESC-FAKE0'.$number_one.'-'.$number_two,
        'unit_price' => $faker->randomFloat(2, 0, 150),
        'purchased_units' => $faker->numberBetween(100, 200),
        'sold_units' => $faker->numberBetween(15, 100)
    ];
});
