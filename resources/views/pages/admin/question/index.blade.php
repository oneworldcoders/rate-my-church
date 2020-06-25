@extends('pages.admin.question.layout')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>

@endif

<div>
  <a class="btn btn-primary" href="{{ route('questions.create') }}">Add a new Question</a>
</div>

@endsection
