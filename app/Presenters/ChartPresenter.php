<?php

namespace App\Presenters;

trait ChartPresenter {

  public function build($datasetName = '', $values = [], $maxScore = 1)
  {
    return [
      'datasets' => [
        [
          'data' => $values,
          'percentages' => $this->calculatePercentages($values),
          'backgroundColor' => $this->randomColors($maxScore),
          'label' => $datasetName
        ]
      ],
      'labels' => range(1, $maxScore)
    ];
  }

  function calculatePercentages($values)
  {
    $percentages = [];
    $sum = array_sum($values);
    foreach($values as $value)
    {
      array_push($percentages, number_format($value * 100 / $sum, 2));
    }
    return $percentages;
  }

  function randomColor()
  {
    return 'rgb('.rand(0, 255).','.rand(0, 255).','.rand(0, 255).')';
  }

  function randomColors($size = 1)
  {
    $result = [];
    for($times = 1; $times <= $size; $times++){
      array_push($result, $this->randomColor());
    }
    return $result;
  }

}

