<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\RatingsService;
use App\User;
use App\Rating;
use App\Question;

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
    $this->questions = factory(Question::class, 3)->create();
    $data = ["1"=>1, "2"=>2, "3"=>5];
    $ratingModel = new Rating;
    $service = new RatingsService;
    $service->updateRatings($user, $this->questions, $data, $ratingModel);

  }

  public function test_add_a_ratings()
  {
    $expectedRating = $this->questions->first()->ratings->first();
    $this->assertEquals($expectedRating->score, 1);
  }

  public function test_adds_multiple_ratings()
  {
    $expectedRating = $this->questions->find(2)->ratings->first();
    $this->assertEquals($expectedRating->score, 2);

    $expectedRating = $this->questions->find(3)->ratings->first();
    $this->assertEquals($expectedRating->score, 5);
  }
  
}
