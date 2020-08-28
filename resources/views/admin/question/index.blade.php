@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __('Questions') }}</div>
          @foreach($questions as $question)
            <li class="list-group-item">
              <div class="row">
                <div class="col col-md-4">
                  <label class="">{{ $question->title }}</label><br>
                  <label class="">{{ $question->description }}</label>
                </div>
                <div class="col col-md-1">
                  <a class="btn btn-primary ml-2" href="{{ route('questions.show', $question) }}">Show</a>
                </div>
                <div class="col col-md-2">
                  <form action="{{ route('questions.destroy', $question) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger ml-2" type="submit">Delete Question</button> 
                  </form>
                </div>
              </div>
              
            </li>
          @endforeach
        <div class="card-body">
            <div class="offset-md-4">
              <a class="btn btn-primary" href="{{ route('questions.create') }}">Add a Question</a>
            </div>
        </div>
      </div>
      
    </div>
  </div>
  

</div>

@endsection
