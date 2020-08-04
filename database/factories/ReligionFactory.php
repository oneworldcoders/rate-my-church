<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Religion;
use Faker\Generator as Faker;

$factory->define(Religion::class, function (Faker $faker) {
  return [
    'name' => $faker->word,
    'description' => $faker->sentence,
  ];
});
