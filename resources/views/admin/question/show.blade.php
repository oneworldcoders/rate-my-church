@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">{{ __($church_name) }}</div>

        <div class="card-body">
          <div class="text-md-center">{{ __($question->description) }}  - ({{ __($question->average_rating) }})</div>
          @if ($ratings)
            <ul class="list-group list-group-flush">
              @foreach ($ratings as $rating)
                <li class="list-group-item">
                  <a>
                    {{ $rating->user_name }} - {{ $rating->score }}
                  </a>
                </li>
              @endforeach
            </ul>
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
let bar_options = {
  title: {
    display: true,
    text: 'Number of Users'
  },
  legend: {
    display: false,
  },
}

let pie_options = {
  title: {
    display: true,
    text: 'Percentage of users',
  },
  tooltips: {
    callbacks: {
      label: function(tooltipItem, data) {
        let dataArray = data.datasets[tooltipItem.datasetIndex].data || '';
        let index = tooltipItem.index;

        let percentageArray = [];
        let sum = 0;
        dataArray.map(data => {
          sum += data;
        });

        dataArray.map(data => {
          percentageArray.push((data * 100 / sum).toFixed(2));
        });

        let label = percentageArray[index] + '%';

        return label;
      }
    }
  }
};

let config_bar = {
  type: 'bar',
  data: {!! json_encode($chart_data) !!},
  options: bar_options,
};

let config_pie = {
  type: 'pie',
  data: {!! json_encode($chart_data) !!},
  options: pie_options, 
};

var ctx = document.getElementById('bar-chart').getContext('2d');
var myChart = new Chart(ctx, config_bar);

var ctx = document.getElementById('pie-chart').getContext('2d');
var myChart = new Chart(ctx, config_pie);
</script>
@endsection
