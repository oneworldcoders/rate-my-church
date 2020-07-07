@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
      @endif

      <div class="card">
        <div class="card-header">{{ __('Churches') }}</div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach ($churches as $church)
              <li class="list-group-item">
                <a href="{{ route('churches.show', $church) }}">{{ $church->name }}</a>
              </li>
            @endforeach
          </ul>

          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('churches.create') }}">Add a Church</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
