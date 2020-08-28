<?php

namespace App\Charts;

use App\Presenters\ChartPresenter;

class RatingBarChart
{
  use ChartPresenter;

  protected $datasetName;
  protected $values;
  protected $count;

  public function __construct($datasetName = 'Number of User', $values = [])
  {
    $this->datasetName = $datasetName;
    $this->values = $values;
  }

  public function makeChartAverage($ratings = [], $maxScore = 5)
  {
    for($score = 1; $score <= $maxScore; $score++){
      array_push($this->values, $ratings->where('score', $score)->count());
    }
    return $this->build($this->datasetName, $this->values, $maxScore);
  }

  public function makeChart($ratings)
  {
    foreach($ratings as $rating){
      array_push($this->values, $rating->score);
    }
    return $this->build($this->datasetName, $this->values, $ratings->count());
  }
}
