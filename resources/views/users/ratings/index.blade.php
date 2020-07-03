@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">{{ __('Ratings for '.$church_name) }}</div>

            <div class="card-body">
              @foreach ($ratings as $rating)
                <li> {{ $rating->description }} - {{ $rating->pivot->rating }}</li>
              @endforeach

            </div>

        </div>
    </div>
</div>
@endsection
