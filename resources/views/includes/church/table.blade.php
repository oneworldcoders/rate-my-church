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
                <div class="row">
                  <label class="col-md-4 text-md-right">{{ $church->name }}</label>
                  @can('create', App\Rating::class)
                    <a class="btn btn-primary ml-2" href="{{ route('ratings.create', ['church' => $church]) }}">Rate Church</a>
                    <a class="btn btn-primary ml-2" href="{{ route('ratings.church_ratings_index', ['church' => $church]) }}">View Ratings</a>
                  @endcan
                  @can('viewAny', App\Church::class)
                    <a class="btn btn-primary ml-2" href="{{ route('churches.show', $church) }}">Church Details</a>
                  @endcan
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>

