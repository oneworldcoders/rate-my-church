<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Church;
use App\Religion;

use Faker\Generator as Faker;

$factory->define(Church::class, function (Faker $faker) {
    $religions = Religion::all();
    $religion_key = array_rand($religions->toArray());
    return [
        'name' => $faker->unique()->name,
        'religion_id' => $religions->count() > 0 ? $religions[$religion_key] : factory(Religion::class)->create(),
    ];
});
