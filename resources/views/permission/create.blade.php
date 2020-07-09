@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.errors')

      <div class="card">
        <div class="card-header">{{ __('Add a Permission') }}</div>

          <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST">
              @csrf

              <div class="form-group row">
                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>
                <div class="col-md-6">
                  <select name="user" id="user" class="form-control">
                    <option value="" disabled>Choose a User</option>
                    @foreach ($users as $user)
                      <option value="{{$user->id}}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Permission') }}</label>
                <div class="col-md-6">
                  <select name="role" id="role" class="form-control">
                    <option value="" disabled>Choose a Role</option>
                    @foreach ($roles as $role)
                      <option value="{{$role->id}}">{{ $role->description }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Add Permission') }}
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
