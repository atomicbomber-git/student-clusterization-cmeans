<?php

use Faker\Generator as Faker;

$factory->define(App\Mahasiswa::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'NIM' => 'D' . $faker->unique->randomNumber(6, TRUE)
    ];
});
