@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.success')

      <div class="card">
        <div class="card-header">{{ __('Admin') }}</div>

        <div class="card-body">
          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('churches.index') }}">Churches</a>
            <a class="btn btn-primary" href="{{ route('questions.create') }}">Add a Question</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
