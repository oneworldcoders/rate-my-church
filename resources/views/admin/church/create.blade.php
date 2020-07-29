@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('includes.auth.errors')

      <div class="card">
        <div class="card-header">{{ __('Add a Church') }}</div>

          <div class="card-body">
            <form action="{{ route('churches.store') }}" method="POST">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Name of Church">
                </div>
              </div>

              <div class="form-group row">
                <label for="religion" class="col-md-4 col-form-label text-md-right">{{ __('Religion') }}</label>
                <div class="col-md-6">
                  <input type="text" name="religion" class="form-control" placeholder="Religious Denomination">
                </div>
              </div>

             <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                  <input type="text" name="address[fullname]" class="form-control" placeholder="Full Address">
                </div>
              </div>

             <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Latitude') }}</label>
                <div class="col-md-6">
                  <input type="text" name="address[lat]" class="form-control" placeholder="Latitude">
                </div>
              </div><div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Longitude') }}</label>
                <div class="col-md-6">
                  <input type="text" name="address[lng]" class="form-control" placeholder="Longitude">
                </div>
              </div> <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Add Church') }}
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
