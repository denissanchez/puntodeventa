<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'ruc' => '123456789'.$faker->numberBetween(10, 99),
        'name' => $faker->company,
        'address' => $faker->address,
        'email' => $faker->companyEmail,
        'phone' => $faker->phoneNumber,
        'website' => $faker->url
    ];
});
