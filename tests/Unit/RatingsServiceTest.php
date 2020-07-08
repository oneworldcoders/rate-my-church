<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Services\RatingsService;
use App\User;
use App\QuestionUser;
use App\Question;

class RatingsServiceTest extends TestCase
{
  /**
   * A basic unit test example.
   *
   * @return void
   */
  /*public function test_update_ratings_adds_a_rating()
  {
    $user = factory(User::class)->create();
    $questions = factory(Question::class, 1)->create();
    $ratingScore = 1;
    $ratingModel = new QuestionUser;
    $service = new RatingsService;
    $service->updateRatings($user, $questions, $ratingScore, $ratingModel);
    $expectedRating = $ratingModel::find(['question_id' => $questions->all->first()->id, 'user_id' => $user->id]);
    $this->assertEquals($expectedRating->rating, $ratingScore);
  }
  */
}
