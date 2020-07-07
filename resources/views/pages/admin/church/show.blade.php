@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">{{ __($church->name) }}</div>

        <div class="card-body">
         <ul class="list-group list-group-flush">
          @foreach ($church->questions as $question)
            <li class="list-group-item">
              <a>
                <strong>{{ $question->title }}</strong>
                <br>
                <p>{{ $question->description }}</p>
              </a>
            </li>
          @endforeach

          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('questions.create') }}">Add a Question</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
