@extends('pages.user.layout')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>

@endif

<div>
  <a class="btn btn-primary" href="{{ route('users.create') }}">Sign Up</a>
</div>

@endsection
