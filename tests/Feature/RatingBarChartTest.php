<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Rating;
use App\Charts\RatingBarChart;

class RatingBarChartTest extends TestCase
{
  use RefreshDatabase;

  protected $rating_bar_chart;
  protected $response;
  protected $ratings;

  public function setUp(): void
  {
    parent::setUp();

    $this->rating_bar_chart = new RatingBarChart();
    $this->ratings = collect([]);
  }

  public function test_scores_are_set_to_dataset_values()
  {
    $scores = [1, 2, 3, 4, 1, 2, 3];
    $scoreCount = [2, 2, 2, 1, 0];

    foreach($scores as $score)
    {
      $this->ratings->push(factory(Rating::class)->create(['score' => $score]));
    }
    $this->response = $this->rating_bar_chart->makeChart($this->ratings);
    $this->assertEquals($this->response['datasets'][0]['values'], $scoreCount);
  }

  public function test_labels_are_from_1_to_maxScore()
  {
    $maxScore = 10;
    $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $this->response = $this->rating_bar_chart->makeChart($this->ratings, $maxScore);
    $this->assertEquals($this->response['chart']['labels'], $expected);
  }
}
