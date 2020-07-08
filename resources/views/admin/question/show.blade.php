@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">{{ __('$ratings->first()->church->name') }}</div>

        <div class="card-body">
          <div class="text-md-center">{{ __('$ratings->first()->question->description') }}</div>
          <ul class="list-group list-group-flush">
            @foreach ($ratings as $rating)
              <li class="list-group-item">
                <a>
                  {{ $rating->user->name }} - {{ $rating->rating }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
