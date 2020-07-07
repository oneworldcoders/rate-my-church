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
                <div class="row">
                  <div class="col-md-4">
                    <a>
                      <strong>{{ $question->title }}</strong>
                      <br>
                      <p>{{ $question->description }}</p>
                    </a>
                  </div>
                  <div >
                    <a class="btn btn-secondary" href="{{ route('questions.show', $question) }}">View Responses</a>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <br></br>
          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('questions.create') }}">Add a Question</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
