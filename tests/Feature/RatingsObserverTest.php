<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Rating;
use App\ChurchQuestion;

class RatingsObserverTest extends TestCase
{
  use RefreshDatabase;

  public function test_averages_single_rating()
  {
    $rating = factory(Rating::class)->create();
    $this->assertEquals($rating->score, $rating->church_question->average_rating);
  }

  public function test_averages_multiple_ratings_multiple_same_question()
  {
    $church_question = factory(ChurchQuestion::class)->create();
    $ratings = factory(Rating::class, 2)
               ->create(['church_question_id'=>$church_question->id, 'score'=>rand(1, 5)]);
    $average = ($ratings->first()->score + $ratings->last()->score)/2;
    $updated_church_question = ChurchQuestion::find($church_question->id);
    $this->assertEquals($average, $updated_church_question->average_rating);
  }

  public function test_averages_multiple_ratings_different_questions()
  {
    $church_questions = factory(ChurchQuestion::class, 2)->create();
    $ratings_q1 = factory(Rating::class, 2)
                  ->create(['church_question_id'=>$church_questions->first()->id, 'score'=>rand(1, 5)]);
    $ratings_q2 = factory(Rating::class, 2)
                  ->create(['church_question_id'=>$church_questions->last()->id, 'score'=>rand(1, 5)]);
   
    $average_q1 = ($ratings_q1->first()->score + $ratings_q1->last()->score)/2;
    $average_q2 = ($ratings_q2->first()->score + $ratings_q2->last()->score)/2;
    
    $updated_church_question_1 = ChurchQuestion::find($church_questions->first()->id);
    $updated_church_question_2 = ChurchQuestion::find($church_questions->last()->id);
    $this->assertEquals($average_q1, $updated_church_question_1->average_rating);
    $this->assertEquals($average_q2, $updated_church_question_2->average_rating);
  }
}
