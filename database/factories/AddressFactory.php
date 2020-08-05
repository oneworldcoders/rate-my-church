<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Church;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
  return [
    'church_id' => factory(Church::class)->create(),
    'fullname' => $faker->word,
    'lat' => -1 * rand(10000, 30000)/10000,
    'lng' => rand(29000, 31000)/10000,
  ];
});
