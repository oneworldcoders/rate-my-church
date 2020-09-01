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
          
          @can('viewResponses', App\Rating::class)
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
                      <div>
                        <a class="btn btn-secondary" href="{{ route('ratings.view_responses', $church_question->id) }}">{{__('View Responses')}}</a>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          @endcan
          <br>
          
          <form action="{{ route('churches.destroy', $church) }}" method="POST">
            @can('delete', $church, App\Church::class)                    
              @csrf
              @method('DELETE')
              <button class="btn btn-danger offset-md-4" type="submit">{{__('Delete Church')}}</button>
            @endcan
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
