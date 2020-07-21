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

      <div id="chart" style="height: 300px;"></div>

    </div>
  </div>
</div>
<script>
var chart_data = {!! json_encode($chart_data) !!};

const chart = new Chartisan({
  el: '#chart',
  data: chart_data,
});
</script>
@endsection
