@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">{{ __($question->church->name) }}</div>
        <div class="card-body">{{ __($question->description) }}</div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach ($question->users as $user)
              <li class="list-group-item">
                <a>
                  {{ $user->name }} - {{ $user->pivot->rating }}
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
