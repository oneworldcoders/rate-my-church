@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __($church->name) }}</div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="card-header">{{ __('Details') }}</div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col-md-4 text-md-right">{{ __('Rating:') }}</div>
                      <div>{{ $church->overall_average }}</div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col-md-4 text-md-right">{{ __('Religion:') }}</div>
                      <div>{{ $church->religion->name }}</div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col-md-4 text-md-right">{{ __('Address:') }}</div>
                      <div>{{ $church->address->fullname }}</div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6" style="height:300px">
              <iframe
                width="100%"
                height="100%"
                frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key={{env('GOOGLE_MAPS_API_KEY')}}
                  &q={{$church->name}}
                  &zoom=13" allowfullscreen>
              </iframe>
            </div>
          </div>
          
          <div class="card-header">{{__('Questions')}}</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @foreach ($church_questions as $church_question)
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-4">
                      <a>
                        <strong>{{ $church_question->question_title }}</strong>
                        <br>
                        <p>{{ $church_question->question_description }}</p>
                      </a>
                    </div>
                    <form action="{{ route('questions.destroy', $church_question->question) }}" method="POST">
                      @can('viewResponses', App\Rating::class)
                        <a class="btn btn-secondary" href="{{ route('ratings.view_responses', $church_question->id) }}">View Responses</a>
                      @endcan
                    
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
          </div>
          <br>
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
