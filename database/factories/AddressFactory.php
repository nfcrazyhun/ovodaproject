<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street_name'=>$faker->streetName,
        'street_number'=>$faker->numberBetween($min = 1, $max = 100),
        'zip'=>$faker->numberBetween($min = 1000, $max = 9999),
        'city'=>$faker->city,
        'siblings_num'=>$faker->numberBetween($min = 0, $max = 3),

    ];
});
