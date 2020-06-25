@extends('pages.admin.church.layout')

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
  <form action="{{ route('churches.store') }}" method="POST">
    @csrf
    <fieldset class=""><legend>Add a Church</legend></fieldset>
    <div class="form-group">
      <strong>Name:</strong>
      <input type="text" name="name" class="form-control" placeholder="Name of Church">
    </div>

    <div class="form-group">
      <strong>Location:</strong>
      <input type="text" name="location" class="form-control" placeholder="Location">
    </div>

    <div class="form-group">
      <strong>Religion:</strong>
      <input type="text" name="religion" class="form-control" placeholder="Religion">
    </div>

    <div class=" text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div> 
  </form>
</div>

@endsection
