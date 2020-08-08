@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @include('includes.auth.success')

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
                  <form action="{{ route('questions.destroy', $question) }}" method="POST">
                    <a class="btn btn-secondary" href="{{ route('ratings.show', $question) }}">View Responses</a>
                    
                    @can('deleteAny', App\Question::class)                    
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete Question</button>
                    @endcan
                  </form>
                </div>
              </li>
            @endforeach
          </ul>
          <br></br>
          @can('create', App\Question::class)
            <div class="offset-md-4">
              <a class="btn btn-primary" href="{{ route('questions.create') }}">Add a Question</a>
            </div>
          @endcan
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
