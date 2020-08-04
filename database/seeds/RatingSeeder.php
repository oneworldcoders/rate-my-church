<?php

use Illuminate\Database\Seeder;

use \App\Question;
use \App\User;
use \App\Rating;

class RatingSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $questions = Question::all();
    $users = User::all();

    foreach($users as $user){
      foreach($questions as $question){
        Rating::create(['user_id' => $user->id, 'question_id' => $question->id, 'score' => rand(1, 5)]);
      }
    }
  }
}
