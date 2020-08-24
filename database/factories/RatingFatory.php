<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
use App\ChurchQuestion;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'church_question_id' => factory(ChurchQuestion::class)->create(),
        'score' => rand(1, 5)
    ];
});
