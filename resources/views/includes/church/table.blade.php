<div class="accordion" id="accordionExample">
  @foreach($religions as $religion)
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <span class="col text-dark" type="button" data-toggle="collapse" data-target="#collapse{{$religion->id}}" aria-expanded="false" aria-controls="collapse{{$religion->id}}">
            {{$religion->name}} Churches
          </span>
        </h5>
      </div>

      <div id="collapse{{$religion->id}}" class="collapse">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach($religion->churches as $church)
              <li class="list-group-item">
                {{ $church->name }}
                <!--
                <a class="btn btn-primary" href="{{ route('ratings.create', $church) }}">Rate Church</a>
                <a class="btn btn-primary" href="{{ route('ratings.index') }}">View Ratings</a>
                -->
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>

