@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')
      <div class="col-md-8 mx-auto">
        <form>
          <div class="row mb-2">
            <div class="col">
              <label for='name'>Name</label>
              <input type="text" placeholder="Name..." name="name">
            </div>
            <div class="col">
              <label for='email'>Email</label>
              <input type="text" placeholder="Email..." name="email">
            </div>
            <div class="col">
              <button class="btn btn-secondary" type="submit">Search</button>
            </div>
          </div>
        </form>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="offset-md-4">
            {{ __('User Permissions') }}
          </div>
        </div>

        <div class="card-body">
          @include('includes.permission.table')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
