<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Factory;
use App\Models\OwnerDocument;
use Faker\Generator as Faker;

$factory->define(OwnerDocument::class, function (Faker $faker) {
    return [
        'identity_document' => '1234567'.$faker->numberBetween(1000, 9999),
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'phone' => '-',
    ];
});
