@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.success')

      <div class="card">
        <div class="card-header">{{ __('User Permissions') }}</div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach ($users as $user)
              @foreach ($user->roles as $role)
                <li class="list-group-item">
                  <p>{{ $user->name }} - {{ $role->description }}</p>
                </li>
              @endforeach
            @endforeach
          </ul>

          <div class="offset-md-4">
            <a class="btn btn-primary" href="{{ route('permissions.create') }}">Add Permissions</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
