@extends('pages.admin.question.layout')

@section('content')

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

<div class="col-xs-9 col-sm-9 col-md-9">
  <form action="{{ route('questions.store') }}" method="POST">
    @csrf
    <fieldset class=""><legend>Add a Question</legend></fieldset>

    <div class="form-group">
      <strong>Church:</strong>
      <select name="church_id" id="church_id" class="form-control">
        <option value="" disabled>Choose a Church</option>
        @foreach ($churches as $church)
          <option value=" {{ $church->id }} ">{{ $church->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <strong>Title:</strong>
      <input type="text" name="title" class="form-control" placeholder="Question Title">
    </div>

    <div class="form-group">
      <strong>Description:</strong>
      <input type="text" name="description" class="form-control" placeholder="Description">
    </div>

    <div class="form-group">
      <strong>Type:</strong>
      <select name="type" id="type" class="form-control">
        <option value="" disabled>Type of Question</option>
        <option value="rate">Rating</option>
      </select>
    </div>

    <div class=" text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div> 
  </form>
</div>

@endsection
