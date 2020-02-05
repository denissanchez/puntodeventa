<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Branch;
use App\Models\OwnerDocument;
use App\Models\Purchase;
use App\User;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    $date = $faker->dateTimeBetween($startDate= '-5 years', $endDate='-10 months');
    return [
        'branch_id' => Branch::all()->random()->id,
        'seller_id' => User::all()->random()->id,
        'provider_id' => OwnerDocument::all()->random()->id,
        'code' => 'DOC-COMPRA-'.$faker->numberBetween(100, 999),
        'date' => $date->format('Y-m-d'),
        'state' => 'COMPLETADO'
    ];
});
