<?php

use Faker\Generator as Faker;
use Viperxes\Rest\Models\Item;

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

$factory->define(Item::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber(7),
        'name' => $faker->unique()->name,
        'amount' => $faker->numberBetween(0, 1000)
    ];
});
