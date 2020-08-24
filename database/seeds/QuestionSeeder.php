<?php

use Illuminate\Database\Seeder;
use \App\Question;
use \App\Church;

class QuestionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(Question::class, 5)->create();
  }
}
