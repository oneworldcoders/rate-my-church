<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ChurchQuestion;
use App\Church;
use App\Question;
use App\Survey;
use Faker\Generator as Faker;

$factory->define(ChurchQuestion::class, function (Faker $faker) {
  return [
    'church_id' => factory(Church::class)->create(),
    'question_id' => factory(Question::class)->create(),
    'survey_id' => factory(Survey::class)->create(),
    'average_rating' => 0.0
  ];
});
