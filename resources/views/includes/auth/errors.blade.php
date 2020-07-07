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
