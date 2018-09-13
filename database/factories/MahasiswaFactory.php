<?php

use Faker\Generator as Faker;

$factory->define(App\Mahasiswa::class, function (Faker $faker) {
    return [
        'NIM' => 'D' . $faker->unique->randomNumber(6, TRUE)
    ];
});
