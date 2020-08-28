@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">{{ __('Question') }}</div>
          
          <div class="card-body">
            <div>
              <a>
                <strong>{{__('Title: ')}}{{ $question->title }}</strong><br>
                <strong>{{__('Description: ')}}</strong><span>{{ $question->description }}</span>
              </a>
            </div>
          </div>
        </div>
        <br>
        <div class="row"> 
          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('questions.index') }}">Questions</a>
          </div>

          <form action="{{ route('questions.destroy', $question) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger ml-2" type="submit">Delete Question</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
