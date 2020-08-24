@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">{{ __($church_name) }}</div>

        <div class="card-body">
          <div class="text-md-center">{{ __($question->description) }}  - ({{ __($question->average_rating) }})</div>
          @if ($ratings)
            @include('includes.ratings.table')
          @else
            <p>No Ratings</p>
            @endif
        </div>
      </div>
      
      <canvas id="bar-chart" style="height: 300px;"></canvas>
      <canvas id="pie-chart" style="height: 300px;"></canvas>
    </div>
  </div>
</div>

<script>
let barOptions = {
  title: {
    display: true,
    text: 'Number of Users'
  },
  legend: {
    display: false,
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  }
}

let pieOptions = {
  title: {
    display: true,
    text: 'Percentage of users',
  },
  tooltips: {
    callbacks: {
      label: function(tooltipItem, data) {
        let percentageArray = data.datasets[tooltipItem.datasetIndex].percentages || [];
        let index = tooltipItem.index;

        return percentageArray[index] + '%';
      }
    }
  },
};

let configBar = {
type: 'bar',
  data: {!! json_encode($chart_data) !!},
  options: barOptions,
};

let configPie = {
type: 'pie',
  data: {!! json_encode($chart_data) !!},
  options: pieOptions, 
};

var ctx = document.getElementById('bar-chart').getContext('2d');
var myChart = new Chart(ctx, configBar);

var ctx = document.getElementById('pie-chart').getContext('2d');
var myChart = new Chart(ctx, configPie);
</script>
@endsection
