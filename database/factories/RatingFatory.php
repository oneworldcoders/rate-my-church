<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'question_id' => factory(Question::class)->create(),
        'user_id' => factory(User::class)->create(),
        'score' => rand(1, 5)
    ];
});
