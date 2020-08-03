<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Church;
use Faker\Generator as Faker;

$factory->define(Church::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'religion' => $faker->word,
    ];
});
