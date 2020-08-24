<?php

use Illuminate\Database\Seeder;
use App\Survey;
use App\Question;

class SurveySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $questions = Question::all();
    $surveys = factory(Survey::class, 2)->create();
    foreach($surveys as $survey){
      $survey->questions()->attach($questions);
    }
  }
}
