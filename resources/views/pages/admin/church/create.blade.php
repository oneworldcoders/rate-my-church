@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if ($errors->any())
        <div class="alert alert-danger col-xs-9 col-sm-9 col-md-9">
          <strong>Warning!</strong> Invalid Input <br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

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
                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                <div class="col-md-6">
                  <input type="text" name="location" class="form-control" placeholder="Location">
                </div>
              </div>

              <div class="form-group row">
                <label for="religion" class="col-md-4 col-form-label text-md-right">{{ __('Religion') }}</label>
                <div class="col-md-6">
                  <input type="text" name="religion" class="form-control" placeholder="Religious Denomination">
                </div>
              </div>

              <div class="form-group row mb-0">
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
