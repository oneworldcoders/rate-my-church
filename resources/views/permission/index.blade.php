@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('includes.auth.success')
      @include('includes.search_bar')

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
