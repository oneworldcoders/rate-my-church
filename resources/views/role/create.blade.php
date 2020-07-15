@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.errors')

      <div class="card">
        <div class="card-header">{{ __('Add a Role') }}</div>

          <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Name of Role">
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                  <input type="text" name="description" class="form-control" placeholder="Description">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Add Role') }}
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
