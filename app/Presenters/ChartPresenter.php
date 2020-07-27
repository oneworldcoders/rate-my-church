<?php

namespace App\Presenters;

trait ChartPresenter {

  public function build($datasetName = '', $values = [], $maxScore = 1)
  {
    return [
      'datasets' => [
        [
          'data' => $values,
          'percentages' => $this->percentages($values),
          'backgroundColor' => $this->randomColorArray($maxScore),
          'label' => $datasetName
        ]
      ],
      'labels' => range(1, $maxScore)
    ];
  }

  function percentages($arrayValues)
  {
    $percentageArray = [];
    $sum = array_sum($arrayValues);
    foreach($arrayValues as $value)
    {
      array_push($percentageArray, number_format($value * 100 / $sum, 2));
    }
    return $percentageArray;
  }

  function randomColor()
  {
    return 'rgb('.rand(0, 255).','.rand(0, 255).','.rand(0, 255).')';
  }

  function randomColorArray($size = 1)
  {
    $result = [];
    for($times = 1; $times <= $size; $times++){
      array_push($result, $this->randomColor());
    }
    return $result;
  }

}

