@extends('pages.admin.church.layout')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>

@endif

<div>
  <a class="btn btn-primary" href="{{ route('church.create') }}">Add a new Church</a>
</div>

@endsection
