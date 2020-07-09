@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">{{ __('Ratings for '.$church_name) }}</div>

            <div class="card-body">
              <ul class="list-group list-group-flush">
                @foreach ($ratings as $rating)
                  <li class="list-group-item"> {{ $rating->description }} - {{ $rating->score }}</li>
                @endforeach
              </ul>

            </div>

        </div>
    </div>
</div>
@endsection
