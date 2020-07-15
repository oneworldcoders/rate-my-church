@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __('Roles') }}</div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach ($roles as $role)
              <li class="list-group-item">
                <a href="#">{{ $role->name }}</a>
              </li>
            @endforeach
          </ul>

          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('roles.create') }}">Add a Role</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
