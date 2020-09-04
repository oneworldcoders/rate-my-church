@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          <div class="offset-md-1">
            @can('create', App\User::class)
              <a class="btn btn-primary" href="{{ route('permissions.index') }}">Permissions</a>
            @endcan
            @can('viewAny', App\Church::class)
              <a class="btn btn-primary" href="{{ route('churches.index') }}">Churches</a>
            @endcan
            @can('viewAny', App\Question::class)
              <a class="btn btn-primary" href="{{ route('questions.index') }}">Questions</a>
            @endcan
            @can('viewAny', App\Survey::class)
              <a class="btn btn-primary" href="{{ route('surveys.index') }}">Surveys</a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
