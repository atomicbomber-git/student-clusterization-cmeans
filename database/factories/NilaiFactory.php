<?php

use Faker\Generator as Faker;

$factory->define(App\Nilai::class, function (Faker $faker) {
    return [
        'IPS' => $faker->biasedNumberBetween(0, 400) / 100,
        'IPK' => $faker->biasedNumberBetween(0, 400) / 100
    ];
});
