<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\ChurchQuestion;
use App\Church;
use App\Survey;

class QuestionObserverTest extends TestCase
{
  use RefreshDatabase;

  public function test_intial_overall_church_average_is_0()
  {
    $church = factory(Church::class)->create();
    $this->assertEquals($church->overall_average, 0);
  }

  public function test_updates_overall_church_average_for_single_question()
  {
    $church = factory(Church::class)->create(['id' => 3]);
    $church_question = factory(ChurchQuestion::class)->create(['church_id' => $church->id]);
    $church_question->update(['average_rating' => 2]);

    $church = Church::find($church->id);
    $this->assertEquals($church->overall_average, 2);
  }

  public function test_updates_overall_church_average_for_multiple_questions()
  {
    $church = factory(Church::class)->create(['id' => 3]);
    $survey = factory(Survey::class)->create();
    $church_questions = factory(ChurchQuestion::class, 2)->create(['church_id' => $church->id, 'survey_id' => $survey->id]);
    $church_questions->first()->update(['average_rating' => 2]);
    $church_questions->last()->update(['average_rating' => 4]);

    $church = Church::find($church->id);
    $this->assertEquals($church->overall_average, 3);
  }
}
