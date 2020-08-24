@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __('Surveys') }}</div>
          @foreach($surveys as $survey)
            <li class="list-group-item">
                <div class="row">
                  <label class="col-md-4 text-md-right">{{ $survey->name }}</label>
                    <a class="btn btn-primary ml-2" href="{{ route('surveys.show', $survey) }}">Show</a>
                    <form action="{{ route('surveys.destroy', $survey) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger ml-2" type="submit">Delete Survey</button>
                    </form>
                  </div>
              </li>
          @endforeach
        <div class="card-body">
            <div class="offset-md-4">
              <a class="btn btn-primary" href="{{ route('surveys.create') }}">Add a Survey</a>
            </div>
        </div>
      </div>
      
    </div>
  </div>
  

</div>

@endsection
