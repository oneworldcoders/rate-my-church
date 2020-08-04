<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Church;
use App\Religion;

use Faker\Generator as Faker;

$factory->define(Church::class, function (Faker $faker) {
    $religions = Religion::all();
    return [
        'name' => $faker->unique()->name,
        'religion_id' => $religions->count() > 0 ? array_rand($religions->toArray()) : factory(Religion::class)->create(),
    ];
});
