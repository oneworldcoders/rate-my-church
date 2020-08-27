<?php

namespace App\Charts;

use App\Presenters\ChartPresenter;

class RatingBarChart
{
  use ChartPresenter;

  protected $datasetName;
  protected $values;
  protected $count;

  public function __construct($datasetName = 'Number of User', $values = [], $count = true)
  {
    $this->datasetName = $datasetName;
    $this->values = $values;
    $this->count = $count;
  }

  public function makeChart($ratings = [], $maxScore = 5)
  {
    if($this->count){
      for($score = 1; $score <= $maxScore; $score++){
        array_push($this->values, $ratings->where('score', $score)->count());
      }
    } else {
      foreach($ratings as $rating){
        array_push($this->values, $rating->score);
      }
    }
    return $this->build($this->datasetName, $this->values, $maxScore);
  }
}
