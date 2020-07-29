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
    $question = Question::where(['title' => 'Choir'])->get()->first();

    $users = User::all();
    foreach($users as $user)
    {
      factory(Rating::class)->create(['user_id' => $user, 'question_id' => $question]);
    }
  }
}
