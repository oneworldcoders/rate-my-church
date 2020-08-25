@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">{{ __('Ratings for '.$church_name) }}</div>

            <div class="card-body">
              <ol class="list-group list-group-flush">
                @foreach ($ratings as $rating)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Question: {{ $loop->index + 1 }}: {{ $rating->description }} <span class="badge badge-primary badge-pill">{{ $rating->score }}</span> </li>
                @endforeach
              </ol>

            </div>

          <canvas id="bar-chart" style="height: 300px;"></canvas>
        </div>
    </div>
</div>

<script>
let barOptions = {
  legend: {
    display: false,
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }],
    xAxes: [{
      ticks: {
        callback: function(value, index, values) {
          return 'Question ' + value
        }
      },
    }]
  }
}

let configBar = {
type: 'bar',
  data: {!! json_encode($chart_data) !!},
  options: barOptions,
};

var ctx = document.getElementById('bar-chart').getContext('2d');
var myChart = new Chart(ctx, configBar);
</script>

@endsection
