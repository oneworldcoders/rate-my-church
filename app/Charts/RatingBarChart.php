<?php

namespace App\Charts;

use App\Presenters\ChartPresenter;

class RatingBarChart
{
  use ChartPresenter;

  protected $datasetName = 'Number of User';
  protected $values = [];

  public function makeChart($ratings, $maxScore = 5)
  {
    for($score = 1; $score <= $maxScore; $score++){
      array_push($this->values, $ratings->where('score', $score)->count());
    }
    return $this->build($this->datasetName, $this->values, $maxScore);
  }
}
