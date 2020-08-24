<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\RatingsService;
use App\User;
use App\Rating;
use App\ChurchQuestion;
use App\Survey;
use App\Church;

class RatingsServiceTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic unit test example.
   *
   * @return void
   */

   protected $questions;

  protected function setup(): void
  {
    parent::setUp();

    $user = factory(User::class)->create();
    $survey = factory(Survey::class)->create();
    $church = factory(Church::class)->create();
    $this->questions = collect();
    $this->church_questions = factory(ChurchQuestion::class, 3)->create(['church_id' => $church->id, 'survey_id' => $survey->id]);
    foreach($this->church_questions as $church_question){
      $this->questions->push($church_question->question);
    }
    $data = ["1"=>1, "2"=>2, "3"=>5];
    $service = new RatingsService;
    $service->updateRatings($user, $this->questions, $church->id, $survey, $data);

  }

  public function test_add_a_ratings()
  {
    $expectedRating = $this->church_questions->first()->ratings->first();
    $this->assertEquals($expectedRating->score, 1);
  }

  public function test_adds_multiple_ratings()
  {
    $expectedRating = $this->church_questions->find(2)->ratings->first();
    $this->assertEquals($expectedRating->score, 2);

    $expectedRating = $this->church_questions->find(3)->ratings->first();
    $this->assertEquals($expectedRating->score, 5);
  }
  
}
