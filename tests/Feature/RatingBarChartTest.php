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
  protected $custom_rating_bar_chart;
  protected $custom_name;
  protected $custom_scores;
  protected $response;
  protected $ratings;
  protected $scores;

  public function setUp(): void
  {
    parent::setUp();

    $this->rating_bar_chart = new RatingBarChart();
    $this->custom_name = 'New Dataset Name';
    $this->custom_scores = [1, 2, 3];
    $this->custom_rating_bar_chart = new RatingBarChart($this->custom_name, $this->custom_scores, false);
    $this->ratings = collect([]);
    $this->scores = [1, 2, 3, 4, 1, 2, 3];

    foreach($this->scores as $score)
    {
      $this->ratings->push(factory(Rating::class)->create(['score' => $score]));
    }
  }

  public function test_scores_are_set_to_dataset_values()
  {
    $scoreCount = [2, 2, 2, 1, 0];
    $this->response = $this->rating_bar_chart->makeChartAverage($this->ratings);
    $this->assertEquals($this->response['datasets'][0]['data'], $scoreCount);
  }

  public function test_labels_are_from_1_to_maxScore()
  {
    $maxScore = 10;
    $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $this->response = $this->rating_bar_chart->makeChartAverage($this->ratings, $maxScore);
    $this->assertEquals($this->response['labels'], $expected);
  }

  public function test_datasetName_is_set_through_constructor()
  {
    $this->response = $this->custom_rating_bar_chart->makeChart($this->ratings);
    $this->assertEquals($this->response['datasets'][0]['label'], $this->custom_name);
  }

  public function test_values_set_through_constructor()
  {
    $this->response = $this->custom_rating_bar_chart->makeChart(collect([]));
    $this->assertEquals($this->response['datasets'][0]['data'], $this->custom_scores);
  }

   public function test_when_count_is_false_values_are_scores()
   {
     $this->response = $this->custom_rating_bar_chart->makeChart($this->ratings);
     $this->assertEquals($this->response['datasets'][0]['data'], array_merge($this->custom_scores, $this->scores));
  }
}
