<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'is_guest' => 0,
        'name' => $faker->name,
        'phonenumber' => $faker->PhoneNumber,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10))
    ];
});
