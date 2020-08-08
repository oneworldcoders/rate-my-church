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
    $churches = Church::all();
    foreach($churches as $church){
      factory(Question::class)->create(['church_id' => $church, 'title' => 'Choir']);
    }
  }
}
