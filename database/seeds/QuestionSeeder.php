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
    $church = Church::where(['name' => "Christ Embassy"])->get()->first();
    factory(Question::class)->create(['church_id' => $church, 'title' => 'Choir']);
    factory(Question::class)->create();
  }
}
