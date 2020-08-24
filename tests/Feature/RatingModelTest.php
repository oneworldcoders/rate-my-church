<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\ChurchQuestion;
use App\Question;
use App\User;
use App\Rating;

class RatingModelTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function test_user_can_have_multiple_ratings()
  {
    $user = factory(User::class)->create();
    $church_questions = factory(ChurchQuestion::class, 2)->create();

    foreach ($church_questions as $church_question)
    {
      Rating::create(['user_id' => $user->id, 'church_question_id' => $church_question->id, 'score' => 1]);
    }
    $this->assertCount(2, $user->ratings);
  }

  public function test_question_can_be_rated_by_multiple_users()
  {
    $church_question = factory(ChurchQuestion::class)->create();
    $users = factory(User::class, 2)->create();

    foreach ($users as $user)
    {
      Rating::create(['user_id' => $user->id, 'church_question_id' => $church_question->id, 'score' => 1]);
    }
    $this->assertCount(2, $church_question->ratings);
  }

  public function test_rating_remains_after_question_is_deleted()
  {
    $rating = factory(Rating::class)->create();
    $question = $rating->question;
    $question->delete();
    $this->assertFalse(Question::where(['question_id' => $question->id])->exists());
    $this->assertEquals($rating->question->id, $question->id);
  }
}
