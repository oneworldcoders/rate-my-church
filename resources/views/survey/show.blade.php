@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">{{ __($survey->name) }}</div>
          
          <div class="card-header">{{__('Questions')}}</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @foreach ($survey->questions as $question)
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-4">
                      <a>
                        <strong>{{ $question->title }}</strong>
                        <br>
                        <p>{{ $question->description }}</p>
                      </a>
                    </div>
                    
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
          <br>
         <div class="row"> 
          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('surveys.create') }}">New Survey</a>
          </div>

          <form action="{{ route('surveys.destroy', $survey) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger ml-2" type="submit">Delete Survey</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
