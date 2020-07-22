<?php

namespace App\Presenters;

trait ChartPresenter {

  public function build($datasetName = '', $values = [], $maxScore = 1)
  {
    return [
      'chart' => [
        'labels' => range(1, $maxScore)
      ],
      'datasets' => [
        [
          'name' => $datasetName,
          'values' => $values
        ]
      ]
    ];
  }

}

