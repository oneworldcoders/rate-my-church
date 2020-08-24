<?php

use Illuminate\Database\Seeder;

use \App\Survey;
use \App\Church;
use \App\User;
use \App\Rating;
use \App\ChurchQuestion;

class RatingSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $surveys = Survey::all();
    $churches = Church::all();
    $users = User::all();

    foreach($surveys as $survey){
      foreach($churches as $church){
        foreach($survey->questions as $question){
          $church_question = ChurchQuestion::create(['question_id' => $question->id, 'survey_id' => $survey->id, 'church_id' => $church->id]);
          foreach($users as $user){
            Rating::create(['user_id' => $user->id, 'church_question_id' => $church_question->id, 'score' => rand(1, 5)]);
          }
        }
      }
    }
  }
}
