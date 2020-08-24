@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.errors')

      <div class="card">
        <div class="card-header">{{ __('Create a Survey') }}</div>

          <div class="card-body">
            <form action="{{ route('surveys.store') }}" method="POST">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Name of Survey" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="questions" class="col-md-4 col-form-label text-md-right">{{ __('Questions') }}</label>

                <div class="col-md-6">

                    @foreach ($questions as $question)
                      <input type="checkbox" name="questions[]" value={{$question->id}}>
                      <label>{{$question->description}}</label>
                      <br>
                    @endforeach

                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Create Survey') }}
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
