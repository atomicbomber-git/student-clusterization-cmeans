<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    
    $nim = 'D' . $faker->unique->randomNumber(6, TRUE);
    
    return [
        'name' => $faker->name,
        'username' => $nim,
        'password' => bcrypt($nim)
    ];
});
