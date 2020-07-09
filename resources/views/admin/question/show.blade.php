@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">{{ __($church_name) }}</div>

        <div class="card-body">
          <div class="text-md-center">{{ __($question->description) }}</div>
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

    </div>
  </div>
</div>

@endsection
