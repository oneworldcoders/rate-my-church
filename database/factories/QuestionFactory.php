<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\Church;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->sentence,
        'type' => $faker->word,
    ];
});
