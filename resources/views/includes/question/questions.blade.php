<br></br>
<div class="card">
  <div class="card-header">{{ $church->name }}</div>

  <div class="card-body">
    <form action="{{ route('ratings.store') }}" method="POST">
      @csrf

      <input type="hidden" name="church" value="{{$church->id}}">

      @foreach ($questions as $question)
        <div class="form-group row">
          <label for="  {{ $question->id }} " class="col-md-4 col-form-label text-md-right">{{ __($question->description ) }}</label>
          <div class="col-md-6">
            <input class="radio-inline m-2" type="radio" name="{{$question->id}}" value="1" required>1
            <input class="radio-inline m-2" type="radio" name="{{$question->id}}" value="2">2
            <input class="radio-inline m-2" type="radio" name="{{$question->id}}" value="3">3
            <input class="radio-inline m-2" type="radio" name="{{$question->id}}" value="4">4
            <input class="radio-inline m-2" type="radio" name="{{$question->id}}" value="5">5
            
          </div>
        </div>
      @endforeach

      <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary">
            {{ __('Submit Response') }}
          </button>
        </div>
      </div>
    </form>
      
  </div>
</div>
