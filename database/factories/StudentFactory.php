<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'group'=>$faker->numberBetween($min = 1, $max = 3),
        'age'=>$faker->numberBetween($min = 4, $max = 7),
    ];
});
