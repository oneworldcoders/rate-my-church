@extends('pages.user.layout')

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
  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    <fieldset class=""><legend>Sign Up</legend></fieldset>

    <div class="form-group">
      <strong>Name:</strong>
      <input type="text" name="name" class="form-control" placeholder="Name">
    </div>

    <div class="form-group">
      <strong>Email:</strong>
      <input type="text" name="email" class="form-control" placeholder="email@example.com">
    </div>

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
      <strong>Password:</strong>
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <div class=" text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div> 
  </form>
</div>

@endsection
