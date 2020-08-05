<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Question;
use App\Church;

class QuestionObserverTest extends TestCase
{
  use RefreshDatabase;

  public function test_intial_overall_church_average_is_0()
  {
    $question = factory(Question::class)->create();
    $church = $question->church;
    $this->assertEquals($church->overall_average, 0);
  }

  public function test_updates_overall_church_average_for_single_question()
  {
    $church = factory(Church::class)->create(['id' => 3]);
    $question = factory(Question::class)->create(['church_id' => $church->id]);
    $question->update(['average_rating' => 2]);

    $church = Church::find($question->church->id);
    $this->assertEquals($church->overall_average, 2);
  }

  public function test_updates_overall_church_average_for_multiple_questions()
  {
    $church = factory(Church::class)->create(['id' => 3]);
    $questions = factory(Question::class, 2)->create(['church_id' => $church->id]);
    $questions->first()->update(['average_rating' => 2]);
    $questions->last()->update(['average_rating' => 4]);

    $church = Church::find($church->id);
    $this->assertEquals($church->overall_average, 3);
  }
}
