<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Rating;
use App\Question;

class RatingsObserverTest extends TestCase
{
  use RefreshDatabase;

  public function test_averages_single_rating()
  {
    $rating = factory(Rating::class)->create();
    $this->assertEquals($rating->score, $rating->question->average_rating);
  }

  public function test_averages_multiple_ratings_multiple_same_question()
  {
    $question = factory(Question::class)->create();
    $ratings = factory(Rating::class, 2)
               ->create(['question_id'=>$question->id, 'score'=>rand(1, 5)]);
    $average = ($ratings->first()->score + $ratings->last()->score)/2;
    $updated_question = Question::find($question->id);
    $this->assertEquals($average, $updated_question->average_rating);
  }

  public function test_averages_multiple_ratings_different_questions()
  {
    $questions = factory(Question::class, 2)->create();
    $ratings_q1 = factory(Rating::class, 2)
                  ->create(['question_id'=>$questions->first()->id, 'score'=>rand(1, 5)]);
    $ratings_q2 = factory(Rating::class, 2)
                  ->create(['question_id'=>$questions->last()->id, 'score'=>rand(1, 5)]);
   
    $average_q1 = ($ratings_q1->first()->score + $ratings_q1->last()->score)/2;
    $average_q2 = ($ratings_q2->first()->score + $ratings_q2->last()->score)/2;
    
    $updated_question_1 = Question::find($questions->first()->id);
    $updated_question_2 = Question::find($questions->last()->id);
    $this->assertEquals($average_q1, $updated_question_1->average_rating);
    $this->assertEquals($average_q2, $updated_question_2->average_rating);
  }
}
