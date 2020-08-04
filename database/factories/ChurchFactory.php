<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Church;
use App\Religion;

use Faker\Generator as Faker;

$factory->define(Church::class, function (Faker $faker) {
  $religions = Religion::all()->pluck('id');
  return [
    'name' => $faker->unique()->name,
    'religion_id' => $religions->count() > 0 ? array_rand(array_flip($religions->toArray())) : factory(Religion::class)->create(),
  ];
});
