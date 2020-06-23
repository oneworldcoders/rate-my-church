@extends('pages.admin.church.layout')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>

@endif

<div>
  <button class="btn btn-default" href="{{ route('church.create') }}">Add a new Church</button>
</div>

@endsection
